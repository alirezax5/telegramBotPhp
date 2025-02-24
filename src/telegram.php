<?php

namespace TelegramBotApiPhp;

use TelegramBotApiPhp\Types\{
    CallbackQuery,
    ChosenInlineResult,
    InlineQuery,
    Message,
    Poll,
    PollAnswer,
    PreCheckoutQuery,
    ShippingQuery
};
use TelegramBotApiPhp\Traits\{
    IsChatTypes,
    IsMedia,
    IsUpdates,
    MethodTrait,
    OtherTrait
};
use telegramBotApiPhp\Types\ChatBoostRemoved;

class Telegram
{
    use IsUpdates, IsChatTypes, IsMedia, MethodTrait, OtherTrait;

    private const API_URL = '{url}/bot{token}/{method}';
    private const FILE_URL = '{url}/file/bot{token}/{file_path}';

    private const CACHE_KEYS = [
        'message' => null,
        'edited_message' => null,
        'channel_post' => null,
        'edited_channel_post' => null,
        'business_connection' => null,
        'business_message' => null,
        'edited_business_message' => null,
        'deleted_business_messages' => null,
        'message_reaction' => null,
        'message_reaction_count' => null,
        'inline_query' => null,
        'chosen_inline_result' => null,
        'callback_query' => null,
        'shipping_query' => null,
        'pre_checkout_query' => null,
        'purchased_paid_media' => null,
        'poll' => null,
        'poll_answer' => null,
        'my_chat_member' => null,
        'chat_member' => null,
        'chat_join_request' => null,
        'chat_boost' => null,
    ];

    private array $data = [];
    private array $cache = self::CACHE_KEYS;
    private string $botToken;
    private string $apiUrl;
    private string $fileUrl;

    public function __construct(string $token, string $apiUrl = 'https://api.telegram.org')
    {
        $this->botToken = $token;
        $this->apiUrl = $apiUrl;
        $this->fileUrl = str_replace('{url}', $apiUrl, self::FILE_URL);
        $this->initialize();
    }

    private function initialize(): void
    {
        $this->data = $this->getInputData();
        $this->clearCache();
    }

    private function getInputData(): array
    {
        return json_decode(file_get_contents('php://input'), true) ?? [];
    }

    private function clearCache(): void
    {
        $this->cache = self::CACHE_KEYS;
    }

    public function bot(string $method, array $data = [], bool $isUpload = false): array
    {
        $data = $this->prepareData($data);
        $url = $this->buildUrl($method);

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_USERAGENT => 'Telegram Bot API Client/1.0',
        ]);

        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return json_decode($response, true) ?? [];
    }

    private function prepareData(array $data): array
    {
        $data['reply_markup'] = $data['reply_markup'] ?? ['inline_keyboard' => []];
        $data['reply_markup'] = json_encode($data['reply_markup']);
        return $data;
    }

    private function buildUrl(string $method): string
    {
        return str_replace(
            ['{url}', '{token}', '{method}'],
            [$this->apiUrl, $this->botToken, $method],
            self::API_URL
        );
    }

    public function getFileUrl(string $filePath): string
    {
        return str_replace(
            ['{url}', '{token}', '{file_path}'],
            [$this->apiUrl, $this->botToken, $filePath],
            self::FILE_URL
        );
    }

    public function getUpdateId(): int
    {
        return $this->data['update_id'] ?? 0;
    }

    public function checkUpdateExists(string $key): bool
    {
        return isset($this->data[$key]) && !empty($this->data[$key]);
    }



    private function getCachedUpdate(string $key, string $class): ?BaseType
    {
        if (!isset($this->cache[$key]) && $this->checkUpdateExists($key)) {
            $this->cache[$key] = $class::create($this->data[$key]);
        }
        return $this->cache[$key] ?? null;
    }

    public function message(): ?Message { return $this->getCachedUpdate('message', Message::class); }
    public function editedMessage(): ?Message { return $this->getCachedUpdate('edited_message', Message::class); }
    public function channelPost(): ?Message { return $this->getCachedUpdate('channel_post', Message::class); }
    public function editedChannelPost(): ?Message { return $this->getCachedUpdate('edited_channel_post', Message::class); }
    public function businessConnection(): ?BusinessConnection { return $this->getCachedUpdate('business_connection', BusinessConnection::class); }
    public function businessMessage(): ?Message { return $this->getCachedUpdate('business_message', Message::class); }
    public function editedBusinessMessage(): ?Message { return $this->getCachedUpdate('edited_business_message', Message::class); }
    public function deletedBusinessMessages(): ?BusinessMessagesDeleted { return $this->getCachedUpdate('deleted_business_messages', BusinessMessagesDeleted::class); }
    public function messageReaction(): ?MessageReactionUpdated { return $this->getCachedUpdate('message_reaction', MessageReactionUpdated::class); }
    public function messageReactionCount(): ?	MessageReactionCountUpdated { return $this->getCachedUpdate('message_reaction_count',MessageReactionCountUpdated::class); }
    public function inlineQuery(): ?InlineQuery { return $this->getCachedUpdate('inline_query', InlineQuery::class); }
    public function chosenInlineResult(): ?ChosenInlineResult { return $this->getCachedUpdate('chosen_inline_result', ChosenInlineResult::class); }
    public function callbackQuery(): ?CallbackQuery { return $this->getCachedUpdate('callback_query', CallbackQuery::class); }
    public function shippingQuery(): ?ShippingQuery { return $this->getCachedUpdate('shipping_query', ShippingQuery::class); }
    public function preCheckoutQuery(): ?PreCheckoutQuery { return $this->getCachedUpdate('pre_checkout_query', PreCheckoutQuery::class); }
    public function purchasedPaidMedia(): ?PreCheckoutQuery { return $this->getCachedUpdate('purchased_paid_media', PreCheckoutQuery::class); }
    public function poll(): ?Poll { return $this->getCachedUpdate('poll', Poll::class); }
    public function pollAnswer(): ?PollAnswer { return $this->getCachedUpdate('poll_answer', PollAnswer::class); }
    public function myChatMember(): ?ChatMemberUpdated { return $this->getCachedUpdate('my_chat_member', ChatMemberUpdated::class); }
    public function chatMember(): ?ChatMemberUpdated { return $this->getCachedUpdate('chat_member', ChatMemberUpdated::class); }
    public function chatJoinRequest(): ?ChatJoinRequest { return $this->getCachedUpdate('chat_join_request', ChatJoinRequest::class); }
    public function chatBoost(): ?ChatBoostUpdated { return $this->getCachedUpdate('chat_boost', ChatBoostUpdated::class); }
    public function removedChatBoost(): ?ChatBoostRemoved { return $this->getCachedUpdate('removed_chat_boost', ChatBoostRemoved::class); }
}