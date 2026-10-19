<?php

declare(strict_types=1);

namespace telegramBotApiPhp;

use telegramBotApiPhp\Traits\{isChatTypes, isMedia, isUpdates, method, otherTrait};
use telegramBotApiPhp\Types\{BaseType,
    BusinessMessagesDeleted,
    CallbackQuery,
    ChatBoostRemoved,
    ChatBoostUpdated,
    ChatJoinRequest,
    ChatMemberUpdated,
    ChosenInlineResult,
    InlineQuery,
    Message,
    MessageReactionCountUpdated,
    MessageReactionUpdated,
    PaidMediaPurchased,
    Poll,
    PollAnswer,
    PreCheckoutQuery,
    ShippingQuery};

class Telegram
{
    use isUpdates,
        isChatTypes,
        isMedia,
        method,
        otherTrait;

    private const API_BASE_URL = 'https://api.telegram.org';
    private const DEFAULT_FILE_URL_TEMPLATE = '{url}/file/bot{token}/{file_path}';

    // Retry Settings
    private int $maxRetries = 3;
    private int $retryDelayMs = 500;
    private int $curlTimeout = 30;
    private ?\CurlHandle $curlHandle = null;

    // Chat & Message Types
    public const PRIVATE = 'private';
    public const GROUP = 'group';
    public const SUPERGROUP = 'supergroup';
    public const CHANNEL = 'channel';

    public const _PHOTO = 'photo';
    public const _VIDEO = 'video';
    public const _FORWARD = 'forward';
    public const _VIDEO_NOTE = 'video_note';
    public const _AUDIO = 'audio';
    public const _VOICE = 'voice';
    public const _ANIMATION = 'animation';
    public const _STICKER = 'sticker';
    public const _DOCUMENT = 'document';
    public const _LOCATION = 'location';
    public const _CONTACT = 'contact';
    public const _GAME = 'game';
    public const _TEXT = 'text';
    public const _MEDIA = 'media';

    public string $urlFile;

    private \stdClass $data;
    private array $cacheType = [];
    private array $cacheField = [];

    private string $botToken;
    private string $apiUrl;
    private string $fileUrlTemplate;

    /** @var array<string> Token Stack for temporary switching */
    private array $tokenStack = [];

    public function __construct(
        string $token,
        string $apiUrl = self::API_BASE_URL,
        string $fileUrlTemplate = self::DEFAULT_FILE_URL_TEMPLATE,
        int    $maxRetries = 3,
        int    $retryDelayMs = 500,
        int    $curlTimeout = 30
    )
    {
        $this->apiUrl = rtrim($apiUrl, '/');
        $this->fileUrlTemplate = $fileUrlTemplate;
        $this->urlFile = $fileUrlTemplate;

        $this->maxRetries = $maxRetries;
        $this->retryDelayMs = $retryDelayMs;
        $this->curlTimeout = max(5, $curlTimeout);
        $this->curlHandle = null;

        $this->setToken($token);
        $this->initialize();
    }

    private function initialize(): void
    {
        $input = file_get_contents('php://input') ?: '{}';
        $decoded = json_decode($input, false);
        $this->data = $decoded instanceof \stdClass ? $decoded : new \stdClass();
        $this->clearCache();
    }

    // ====================== Token Management ======================

    public function setToken(string $token): self
    {
        $this->botToken = $token;
        $template = $this->fileUrlTemplate;
        if (!str_contains($template, '{file_path}')) {
            $template = rtrim($template, '/') . '/file/bot{token}/{file_path}';
        }
        $this->urlFile = str_replace(['{url}', '{token}'], [$this->apiUrl, $token], $template);
        $this->clearCache();
        return $this;
    }

    public function getToken(): string
    {
        return $this->botToken;
    }

    public function switchToken(string $newToken): self
    {
        $this->tokenStack[] = $this->botToken;
        $this->setToken($newToken);
        return $this;
    }

    public function restoreToken(): self
    {
        if (empty($this->tokenStack)) {
            return $this;
        }

        $previousToken = array_pop($this->tokenStack);
        $this->setToken($previousToken);
        return $this;
    }

    public function clearTokenStack(): self
    {
        $this->tokenStack = [];
        return $this;
    }

    public function getTokenStackCount(): int
    {
        return count($this->tokenStack);
    }

    // ====================== Core API ======================

    /** @var ?\Closure API trace hook — set via onApiCall(); fires once per API call. */
    private static ?\Closure $apiTraceCallback = null;

    /**
     * Register a process-wide observer fired after EVERY Bot API call
     * (all instances, all tokens). Receives one compact $info array:
     * [method, duration_ms, ok, chat_id?, error_code?, description?, retry_after?].
     * Full payloads are intentionally NOT passed — keep logging cheap and
     * private. Pass null to unregister. Used by telegramBase's LOG_API_TRACE.
     */
    public static function onApiCall(?\Closure $callback): void
    {
        self::$apiTraceCallback = $callback;
    }

    public function bot(string $method, array $data = [], bool $isUpload = false): ?\stdClass
    {
        // Normalize EVERY payload at the raw choke point (2026-10-13).
        // Raw callers previously bypassed prepareBotData(), so array
        // reply_markup / prices / entities / allowed_updates went over
        // the wire as PHP-array POST fields and Telegram answered
        // "can't parse ... JSON object" (found in production: every
        // keyboard-bearing edit 400'd silently). Typed methods already
        // normalize; prepareBotData() is idempotent (is_array guards +
        // CURLFile passthrough), so double preparation is a no-op.
        $data = $this->prepareBotData($data);

        $t0 = microtime(true);
        $result = $this->botExecute($method, $data, $isUpload);
        $this->traceApiCall($method, $data, $t0, $result);

        return $result;
    }

    private function traceApiCall(string $method, array $data, float $t0, ?\stdClass $result): void
    {
        if (self::$apiTraceCallback === null) {
            return;
        }

        try {
            $ok = is_object($result) && !empty($result->ok);

            $info = [
                'method'      => $method,
                'duration_ms' => (int) round((microtime(true) - $t0) * 1000),
                'ok'          => $ok,
            ];

            if (isset($data['chat_id']) && is_scalar($data['chat_id'])) {
                $info['chat_id'] = $data['chat_id'];
            }

            if (!$ok && is_object($result)) {
                $info['error_code']  = $result->error_code ?? $result->http_code ?? null;
                $info['description'] = $result->description ?? $result->error ?? null;
                if (isset($result->parameters->retry_after)) {
                    $info['retry_after'] = $result->parameters->retry_after;
                }
            }

            (self::$apiTraceCallback)($info);
        } catch (\Throwable) {
            // Tracing must never break an API call.
        }
    }

    private function botExecute(string $method, array $data = [], bool $isUpload = false): ?\stdClass
    {
        $url = $this->buildUrl($method);
        $attempt = 0;
        $curlError = '';
        $httpCode = 0;
        $retryAfter = 0;
        $handle = $this->getCurlHandle();

        while ($attempt <= $this->maxRetries) {
            // Reset the per-call timeout on the persistent handle first: a
            // previous long-poll getUpdates may have raised it, and non-poll
            // calls must not inherit that raised timeout.
            curl_setopt($handle, CURLOPT_TIMEOUT, $this->curlTimeout);
            curl_setopt($handle, CURLOPT_URL, $url);
            curl_setopt($handle, CURLOPT_POSTFIELDS, $data);

            // Long polling: let the request outlive the curl timeout so we don't cut
            // the connection before Telegram answers (getUpdates may hold up to 50-60s).
            if ($method === 'getUpdates' && isset($data['timeout']) && $data['timeout'] !== null) {
                curl_setopt($handle, CURLOPT_TIMEOUT, (int) $data['timeout'] + 5);
            }

            $response = curl_exec($handle);
            $curlError = (string) curl_error($handle);
            $httpCode = (int) curl_getinfo($handle, CURLINFO_RESPONSE_CODE);

            if ($response !== false) {
                $decoded = json_decode($response, false);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $retryAfter = $this->extractRetryAfter($decoded);
                    if ($retryAfter > 0 && $this->shouldRetry($curlError, $httpCode, $attempt)) {
                        usleep($retryAfter * 1_000_000);
                        $attempt++;
                        continue;
                    }
                    return $decoded;
                }
            }

            $attempt++;
            if (!$this->shouldRetry($curlError, $httpCode, $attempt)) {
                break;
            }

            $delay = $this->retryDelayMs * (2 ** ($attempt - 1));
            usleep($delay * 1000);
        }

        return (object)[
            'ok' => false,
            'error' => $curlError ?: 'API Error after ' . $attempt . ' attempts',
            'http_code' => $httpCode,
            'attempts' => $attempt,
        ];
    }

    private function extractRetryAfter(\stdClass $decoded): int
    {
        if (isset($decoded->parameters->retry_after) && is_numeric($decoded->parameters->retry_after)) {
            return (int) $decoded->parameters->retry_after;
        }

        return 0;
    }

    private function getCurlHandle(): \CurlHandle
    {
        if ($this->curlHandle instanceof \CurlHandle) {
            return $this->curlHandle;
        }

        $handle = curl_init();

        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => $this->curlTimeout,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_USERAGENT => 'Telegram Bot API Client/2.0 (PHP)',
            CURLOPT_HTTPHEADER => ['Accept: application/json'],
            CURLOPT_SAFE_UPLOAD => true,
        ];

        curl_setopt_array($handle, $options);

        return $this->curlHandle = $handle;
    }

    public function close(): void
    {
        if ($this->curlHandle instanceof \CurlHandle) {
            // No curl_close() — deprecated since PHP 8.5 and a no-op since
            // 8.0; dropping the reference lets the engine free the handle
            // with identical effect and no deprecation notice on 8.5+.
            $this->curlHandle = null;
        }
    }

    public function __destruct()
    {
        $this->close();
    }

    private function shouldRetry(string $curlError, int $httpCode, int $attempt): bool
    {
        if ($attempt > $this->maxRetries) return false;
        if (!empty($curlError)) return true;
        if ($httpCode >= 500 && $httpCode < 600) return true;
        if ($httpCode === 429) return true;
        return false;
    }

    private function buildUrl(string $method): string
    {
        return "{$this->apiUrl}/bot{$this->botToken}/{$method}";
    }

    public function getFileUrl(string $filePath): string
    {
        $template = $this->fileUrlTemplate;
        if (!str_contains($template, '{file_path}')) {
            // Tolerate a plain base URL passed where a template is expected
            // (older BotManager versions pass BOT_API_URL_FILE directly).
            // Without this, every file download collapsed to the API root
            // and fetched the api.telegram.org HTML portal instead of the
            // file (HTTP 200 text/html — finfo then rejected it).
            $template = rtrim($template, '/') . '/file/bot{token}/{file_path}';
        }

        return str_replace(
            ['{url}', '{token}', '{file_path}'],
            [$this->apiUrl, $this->botToken, ltrim($filePath, '/')],
            $template
        );
    }

    public function getInputData(): \stdClass
    {
        return $this->data;
    }

    public function setInputData(array|\stdClass|BaseType $data): \stdClass
    {
        $this->clearCache();

        if ($data instanceof BaseType) {
            $data = json_decode(json_encode($data, JSON_UNESCAPED_UNICODE), false);
        }

        if (is_array($data)) {
            $data = json_decode(json_encode($data, JSON_UNESCAPED_UNICODE), false);
        }

        return $this->data = $data instanceof \stdClass ? $data : new \stdClass();
    }

    public function clearCache(): void
    {
        $this->cacheType = [];
        $this->cacheField = [];
    }

    private function getCachedUpdate(string $key, string $class): ?BaseType
    {
        if (!array_key_exists($key, $this->cacheType) && $this->checkUpdateExists($key)) {
            $this->cacheType[$key] = new $class($this->data->$key);
        }
        return $this->cacheType[$key] ?? null;
    }

    public function message(): ?Message
    {
        return $this->getCachedUpdate('message', Message::class);
    }

    public function editedMessage(): ?Message
    {
        return $this->getCachedUpdate('edited_message', Message::class);
    }

    public function callbackQuery(): ?CallbackQuery
    {
        return $this->getCachedUpdate('callback_query', CallbackQuery::class);
    }

    public function preCheckoutQuery(): ?PreCheckoutQuery
    {
        return $this->getCachedUpdate('pre_checkout_query', PreCheckoutQuery::class);
    }

    // Telegram Specific Updates
    public function channelPost(): ?Message
    {
        return $this->getCachedUpdate('channel_post', Message::class);
    }

    public function editedChannelPost(): ?Message
    {
        return $this->getCachedUpdate('edited_channel_post', Message::class);
    }

    public function businessMessage(): ?Message
    {
        return $this->getCachedUpdate('business_message', Message::class);
    }

    public function editedBusinessMessage(): ?Message
    {
        return $this->getCachedUpdate('edited_business_message', Message::class);
    }

    public function deletedBusinessMessages(): ?BusinessMessagesDeleted
    {
        return $this->getCachedUpdate('deleted_business_messages', BusinessMessagesDeleted::class);
    }

    public function messageReaction(): ?MessageReactionUpdated
    {
        return $this->getCachedUpdate('message_reaction', MessageReactionUpdated::class);
    }

    public function messageReactionCount(): ?MessageReactionCountUpdated
    {
        return $this->getCachedUpdate('message_reaction_count', MessageReactionCountUpdated::class);
    }

    public function inlineQuery(): ?InlineQuery
    {
        return $this->getCachedUpdate('inline_query', InlineQuery::class);
    }

    public function chosenInlineResult(): ?ChosenInlineResult
    {
        return $this->getCachedUpdate('chosen_inline_result', ChosenInlineResult::class);
    }

    public function shippingQuery(): ?ShippingQuery
    {
        return $this->getCachedUpdate('shipping_query', ShippingQuery::class);
    }

    public function purchasedPaidMedia(): ?PaidMediaPurchased
    {
        return $this->getCachedUpdate('purchased_paid_media', PaidMediaPurchased::class);
    }
    public function poll(): ?Poll
    {
        return $this->getCachedUpdate('poll', Poll::class);
    }
    public function pollAnswer(): ?PollAnswer
    {
        return $this->getCachedUpdate('poll_answer', PollAnswer::class);
    }

    public function myChatMember(): ?ChatMemberUpdated
    {
        return $this->getCachedUpdate('my_chat_member', ChatMemberUpdated::class);
    }
    public function chatMember(): ?ChatMemberUpdated
    {
        return $this->getCachedUpdate('chat_member', ChatMemberUpdated::class);
    }

    public function chatJoinRequest(): ?ChatJoinRequest
    {
        return $this->getCachedUpdate('chat_join_request', ChatJoinRequest::class);
    }
    public function chatBoost(): ?ChatBoostUpdated
    {
        return $this->getCachedUpdate('chat_boost', ChatBoostUpdated::class);
    }
    public function removedChatBoost(): ?ChatBoostRemoved
    {
        return $this->getCachedUpdate('removed_chat_boost', ChatBoostRemoved::class);
    }

    public function checkUpdateExists(string $key): bool
    {
        return isset($this->data->$key) && !empty($this->data->$key);
    }

    public function getUpdateId(): int
    {
        return $this->data->update_id ?? 0;
    }
}