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
    Message,
    MessageReactionCountUpdated,
    MessageReactionUpdated,
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
        int    $retryDelayMs = 500
    )
    {
        $this->apiUrl = rtrim($apiUrl, '/');
        $this->fileUrlTemplate = $fileUrlTemplate;
        $this->urlFile = $fileUrlTemplate;

        $this->maxRetries = $maxRetries;
        $this->retryDelayMs = $retryDelayMs;

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
        $this->urlFile = str_replace('{token}', $token, $this->fileUrlTemplate);
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

    public function bot(string $method, array $data = [], bool $isUpload = false): ?\stdClass
    {
        $url = $this->buildUrl($method);
        $attempt = 0;

        while ($attempt <= $this->maxRetries) {
            $ch = curl_init();

            $options = [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_CONNECTTIMEOUT => 5,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_USERAGENT => 'Telegram Bot API Client/2.0 (PHP)',
                CURLOPT_HTTPHEADER => ['Accept: application/json'],
            ];

            if ($isUpload) {
                $options[CURLOPT_SAFE_UPLOAD] = true;
            }

            curl_setopt_array($ch, $options);

            $response = curl_exec($ch);
            $curlError = curl_error($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($response !== false) {
                $decoded = json_decode($response, false);
                if (json_last_error() === JSON_ERROR_NONE) {
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
            'http_code' => $httpCode ?? 0,
            'attempts' => $attempt,
        ];
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
        return str_replace(
            ['{url}', '{token}', '{file_path}'],
            [$this->apiUrl, $this->botToken, ltrim($filePath, '/')],
            $this->fileUrlTemplate
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

    public function inlineQuery(): ?inlineQuery
    {
        return $this->getCachedUpdate('inline_query', inlineQuery::class);
    }

    public function chosenInlineResult(): ?ChosenInlineResult
    {
        return $this->getCachedUpdate('chosen_inline_result', ChosenInlineResult::class);
    }

    public function shippingQuery(): ?ShippingQuery
    {
        return $this->getCachedUpdate('shipping_query', ShippingQuery::class);
    }

    public function purchasedPaidMedia(): ?PreCheckoutQuery
    {
        return $this->getCachedUpdate('purchased_paid_media', PreCheckoutQuery::class);
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