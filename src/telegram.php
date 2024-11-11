<?php

namespace telegramBotApiPhp;

use telegramBotApiPhp\Types\{CallbackQuery,
    ChosenInlineResult,
    InlineQuery,
    Message,
    Poll,
    PollAnswer,
    PreCheckoutQuery,
    ShippingQuery
};
use telegramBotApiPhp\Traits\{isChatTypes, isMedia, isUpdates, method, otherTrait};

class telegram
{
    use isUpdates;
    use isChatTypes;
    use isMedia;
    use otherTrait;
    use method;

    const PRIVATE = 'private';
    const GROUP = 'group';
    const SUPERGROUP = 'supergroup';
    const CHANNEL = 'channel';
    const _PHOTO = 'photo';
    const _VIDEO = 'video';
    const _FORWARD = 'forward';
    const _VIDEO_NOTE = 'video_note';
    const _AUDIO = 'audio';
    const _VOICE = 'voice';
    const _ANIMATION = 'animation';
    const _STICKER = 'sticker';
    const _DOCUMENT = 'document';
    const _LOCATION = 'location';
    const _CONTACT = 'contact';
    const _GAME = 'game';
    const _TEXT = 'text';
    const _MEDIA = 'media';
    public $data = [];
    public $reqData;
    public $bot_token;
    public $urlForRequest;
    public $url = '{url}/bot{token}/{method}';
    public $urlFile = '{url}/file/bot{token}/';
    private $cacheTypes = [
        'Message' => null,
        'edited_message' => null,
        'channel_post' => null,
        'edited_channel_post' => null,
        'inline_query' => null,
        'chosen_inline_result' => null,
        'callback_query' => null,
        'shipping_query' => null,
        'pre_checkout_query' => null,
        'poll' => null,
        'poll_answer' => null,
    ];
    private $caches = [
        'chatType' => null,
        'text' => null,
        'message_id' => null,
        'chatId' => null,
        'fromId' => null,
        'msgType' => null,
        'mediaType' => null,
        'fileId' => null,
        'firstName' => null,
        'lastName' => null,
        'username' => null,
        'caption' => null,
        'language_code' => null,
        'is_premium' => null,
    ];

    //region init
    public function __construct(string $token, $urlForRequest = 'https://api.telegram.org/')
    {

        $this->urlForRequest = (string)$urlForRequest;
        $this->bot_token = (string)$token;
        $this->clearCache();
        $this->Set_data();
    }

    private function clearCache()
    {
        $this->cacheTypes['Message'] = null;
        $this->cacheTypes['edited_message'] = null;
        $this->cacheTypes['channel_post'] = null;
        $this->cacheTypes['edited_channel_post'] = null;
        $this->cacheTypes['inline_query'] = null;
        $this->cacheTypes['chosen_inline_result'] = null;
        $this->cacheTypes['callback_query'] = null;
        $this->cacheTypes['shipping_query'] = null;
        $this->cacheTypes['pre_checkout_query'] = null;
        $this->cacheTypes['poll'] = null;
        $this->cacheTypes['poll_answer'] = null;
        $this->caches['chatType'] = null;
        $this->caches['text'] = null;
        $this->caches['message_id'] = null;
        $this->caches['chatId'] = null;
        $this->caches['fromId'] = null;
        $this->caches['msgType'] = null;
        $this->caches['mediaType'] = null;
        $this->caches['fileId'] = null;
        $this->caches['firstName'] = null;
        $this->caches['lastName'] = null;
        $this->caches['username'] = null;
        $this->caches['filesize'] = null;
        $this->caches['caption'] = null;
    }

    //endregion init

    public function bot(string $method, array $datas = [], $upload = null)
    {
        $datas = $this->checkData($datas);
        $ch = curl_init();
        $options = [
            CURLOPT_URL => $this->getReadlUrl($method),
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $datas,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_SSL_VERIFYPEER => 2,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13'
        ];
        curl_setopt_array($ch, $options);

        $res = curl_exec($ch);
        $StatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $this->reqData = json_decode($res, true);
        return json_decode($res, true);

    }

    private function getReadlUrl($method)
    {
        return strtr($this->url, ['{token}' => $this->bot_token, '{method}' => $method, '{url}' => $this->urlForRequest]);
    }

    private function checkData($datas)
    {

        if (isset($datas['reply_markup']) and $datas != null) {
            $datas['reply_markup'] = json_encode($datas['reply_markup']);
        } else {
            $datas['reply_markup'] = json_encode(['inline_keyboard' => []]);
        }
        return $datas;
    }

    public function Get_data()
    {

        return empty($this->data) ? json_decode(file_get_contents('php://input'), true) : $this->data;
    }

    public function Set_data()
    {
        $this->data = $this->Get_data();
    }

    //region Update

    /**
     * @return Message
     */
    public function message()
    {
        $cache = $this->cacheTypes['Message'];
        if ($cache == null) {
            if ($this->checkExistUpdate('message')) {
                $cache = Message::create($this->data['message']);
                $this->cacheTypes['Message'] = $cache;
            }

        }
        return $cache;
    }


    /**
     * @return Message
     */
    public function edited_message()
    {

        $cache = $this->cacheTypes['edited_message'];
        if ($cache == null) {
            if ($this->checkExistUpdate('edited_message')) {
                $cache = Message::create($this->data['edited_message']);
                $this->cacheTypes['edited_message'] = $cache;
            }
        }
        return $cache;
    }

    /**
     * @return Message
     */
    public function channel_post()
    {
        $cache = $this->cacheTypes['channel_post'];
        if ($cache == null) {
            if ($this->checkExistUpdate('channel_post')) {
                $cache = Message::create($this->data['channel_post']);
                $this->cacheTypes['channel_post'] = $cache;
            }
        }
        return $cache;
    }

    /**
     * @return Message
     */
    public function edited_channel_post()
    {
        $cache = $this->cacheTypes['edited_channel_post'];
        if ($cache == null) {
            if ($this->checkExistUpdate('edited_channel_post')) {
                $cache = Message::create($this->data['edited_channel_post']);
                $this->cacheTypes['edited_channel_post'] = $cache;
            }
        }
        return $cache;
    }

    /**
     * @return InlineQuery
     */
    public function inline_query()
    {
        $cache = $this->cacheTypes['inline_query'];
        if ($cache == null) {
            if ($this->checkExistUpdate('inline_query')) {
                $cache = InlineQuery::create($this->data['inline_query']);
                $this->cacheTypes['inline_query'] = $cache;
            }

        }
        return $cache;
    }

    /**
     * @return ChosenInlineResult
     */
    public function chosen_inline_result()
    {
        $cache = $this->cacheTypes['chosen_inline_result'];
        if ($cache == null) {
            if ($this->checkExistUpdate('chosen_inline_result')) {
                $cache = ChosenInlineResult::create($this->data['chosen_inline_result']);
                $this->cacheTypes['chosen_inline_result'] = $cache;
            }
        }
        return $cache;
    }

    /**
     * @return CallbackQuery
     */
    public function callback_query()
    {
        $cache = $this->cacheTypes['callback_query'];
        if ($cache == null) {
            if ($this->checkExistUpdate('callback_query')) {
                $cache = CallbackQuery::create($this->data['callback_query']);
                $this->cacheTypes['callback_query'] = $cache;
            }
        }
        return $cache;
    }

    /**
     * @return ShippingQuery
     */
    public function shipping_query()
    {
        $cache = $this->cacheTypes['shipping_query'];
        if ($cache == null) {
            if ($this->checkExistUpdate('shipping_query')) {
                $cache = ShippingQuery::create($this->data['shipping_query']);
                $this->cacheTypes['shipping_query'] = $cache;
            }
        }
        return $cache;
    }

    /**
     * @return PreCheckoutQuery
     */
    public function pre_checkout_query()
    {
        $cache = $this->cacheTypes['pre_checkout_query'];
        if ($cache == null) {
            if ($this->checkExistUpdate('pre_checkout_query')) {
                $cache = PreCheckoutQuery::create($this->data['pre_checkout_query']);
                $this->cacheTypes['pre_checkout_query'] = $cache;
            }
        }
        return $cache;
    }

    /**
     * @return Poll
     */
    public function poll()
    {
        $cache = $this->cacheTypes['poll'];
        if ($cache == null) {
            if ($this->checkExistUpdate('poll')) {
                $cache = Poll::create($this->data['poll']);
                $this->cacheTypes['poll'] = $cache;
            }
        }
        return $cache;
    }

    /**
     * @return PollAnswer
     */
    public function poll_answer()
    {
        $cache = $this->cacheTypes['poll_answer'];
        if ($cache == null) {
            if ($this->checkExistUpdate('poll_answer')) {
                $cache = PollAnswer::create($this->data['poll_answer']);
                $this->cacheTypes['poll_answer'] = $cache;
            }
        }
        return $cache;
    }

    //endregion Update

    public function checkExistUpdate($update): bool
    {
        return isset($this->data[$update]) && (!is_array($this->data[$update]) || (is_array($this->data[$update]) && !empty($this->data[$update])));
    }

    public function update_id()
    {
        return $this->data['update_id'];
    }

    public function patchToUrl($patch)
    {
        return $this->urlFile . $this->bot_token . "/" . $patch;
    }

}
