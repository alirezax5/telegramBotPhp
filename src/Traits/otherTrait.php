<?php


namespace telegramBotApiPhp\Traits;


trait otherTrait
{

    public function messageID()
    {
        $message_id = null;
        if ($this->caches['message_id'] != null) {
            return $this->caches['message_id'];
        }
        if ($this->isMessage()) {
            $message_id = $this->message()->getMessageId();
        }
        if ($this->isCallbackQuery() and $this->callback_query()->issetMessage()) {
            $message_id = $this->callback_query()->getMessage()->getMessageId();
        }
        if ($this->isChannelPost()) {
            $message_id = $this->channel_post()->getMessageId();
        }
        if ($this->isEditedMessage()) {
            $message_id = $this->edited_message()->getMessageId();
        }
        if ($this->isEditedChannelPost()) {
            $message_id = $this->edited_channel_post()->getMessageId();
        }
        $this->caches['message_id'] = $message_id;
        return $message_id;
    }
    public function text()
    {
        $text = null;
        if ($this->caches['text'] != null) {
            return $this->caches['text'];
        }
        if ($this->isMessage()) {
            $text = $this->message()->getText();
        }
        if ($this->isCallbackQuery() and $this->callback_query()->issetMessage()) {
            $text = $this->callback_query()->getMessage()->getText();
        }
        if ($this->isChannelPost()) {
            $text = $this->channel_post()->getText();
        }
        if ($this->isEditedMessage()) {
            $text = $this->edited_message()->getText();
        }
        if ($this->isEditedChannelPost()) {
            $text = $this->edited_channel_post()->getText();
        }  if ($this->isInlineQuery()) {
            $text = $this->inline_query()->getQuery();
        }
        $this->caches['text'] = $text;
        return $text;
    }

    public function fromId()
    {
        $fromId = null;
        if ($this->caches['fromId'] != null) {
            return $this->caches['fromId'];
        }
        if ($this->isMessage() and $this->message()->issetFrom()) {
            $fromId = $this->message()->getFrom()->getId();
        }
        if ($this->isCallbackQuery()) {
            if ($this->callback_query()->issetFrom()) {
                $fromId = $this->callback_query()->getFrom()->getId();
            } else {
                $fromId = $this->callback_query()->getMessage()->getChat()->getId();
            }
        }
        if ($this->isChannelPost() and $this->channel_post()->issetFrom()) {
            $fromId = $this->channel_post()->getFrom()->getId();
        }
        if ($this->isEditedMessage() and $this->edited_message()->issetFrom()) {
            $fromId = $this->edited_message()->getFrom()->getId();
        }
        if ($this->isEditedChannelPost() and $this->edited_channel_post()->issetFrom()) {
            $fromId = $this->edited_channel_post()->getFrom()->getId();
        }
        if ($this->isInlineQuery()) {
            $fromId = $this->inline_query()->getFrom()->getId();
        }
        $this->caches['fromId'] = $fromId;
        return $fromId;
    }

    public function chatId()
    {
        $chatId = null;
        if ($this->caches['chatId'] != null) {
            return $this->caches['chatId'];
        }
        if ($this->isMessage()) {
            $chatId = $this->message()->getChat()->getId();
        }
        if ($this->isCallbackQuery() and $this->callback_query()->issetMessage()) {
            if ($this->callback_query()->issetMessage()) {
                $chatId = $this->callback_query()->getMessage()->getChat()->getId();

            }
        }
        if ($this->isChannelPost()) {
            $chatId = $this->channel_post()->getChat()->getId();
        }
        if ($this->isEditedMessage()) {
            $chatId = $this->edited_message()->getChat()->getId();
        }
        if ($this->isEditedChannelPost()) {
            $chatId = $this->edited_channel_post()->getChat()->getId();
        }
        $this->caches['chatId'] = $chatId;
        return $chatId;
    }

    public function firstName()
    {
        $firstName = null;
        if ($this->caches['firstName'] != null) {
            return $this->caches['firstName'];
        }
        if ($this->isMessage()) {
            $firstName = $this->message()->getFrom()->getfirstName();
        }
        if ($this->isCallbackQuery() and $this->callback_query()->issetMessage()) {
            $firstName = $this->callback_query()->getMessage()->getFrom()->getfirstName();
        }
        if ($this->isChannelPost()) {
            $firstName = $this->channel_post()->getFrom()->getfirstName();
        }
        if ($this->isEditedMessage()) {
            $firstName = $this->edited_message()->getFrom()->getfirstName();

        }
        if ($this->isEditedChannelPost()) {
            $firstName = $this->edited_channel_post()->getFrom()->getfirstName();
        }
        if ($this->isInlineQuery()) {
            $firstName = $this->inline_query()->getFrom()->getFirstName();
        }
        $this->caches['firstName'] = $firstName;
        return $firstName;
    }

    public function lastName()
    {
        $lastName = null;
        if ($this->caches['lastName'] != null) {
            return $this->caches['lastName'];
        }
        if ($this->isMessage()) {
            $lastName = $this->message()->getFrom()->issetlastName() == true ? $this->message()->getFrom()->getlastName() : null;
        }
        if ($this->isCallbackQuery() and $this->callback_query()->issetMessage()) {
            $lastName = $this->callback_query()->getMessage()->getFrom()->issetlastName() == true ? $this->callback_query()->getMessage()->getFrom()->getlastName() : null;
        }
        if ($this->isChannelPost()) {
            $lastName = $this->channel_post()->getFrom()->issetlastName() == true ? $this->channel_post()->getFrom()->getlastName() : null;
        }
        if ($this->isEditedMessage()) {
            $lastName = $this->edited_message()->getFrom()->issetlastName() == true ? $this->edited_message()->getFrom()->getlastName() : null;

        }
        if ($this->isEditedChannelPost()) {
            $lastName = $this->edited_channel_post()->getFrom()->issetlastName() == true ? $this->edited_channel_post()->getFrom()->getlastName() : null;
        }
        $this->caches['lastName'] = $lastName;
        return $lastName;
    }

    public function username()
    {
        $username = null;
        if ($this->caches['username'] != null) {
            return $this->caches['username'];
        }
        if ($this->isMessage()) {
            $username = $this->message()->getFrom()->issetUsername() == true ? $this->message()->getFrom()->getUsername() : null;
        }
        if ($this->isCallbackQuery()) {
            if ($this->callback_query()->issetMessage()) {
                $username = $this->callback_query()->getMessage()->getFrom()->getUsername();
            } else {
                $username = $this->callback_query()->getFrom()->getUsername();
            }
        }
        if ($this->isChannelPost()) {
            $username = $this->channel_post()->getFrom()->issetUsername() == true ? $this->channel_post()->getFrom()->getUsername() : null;
        }
        if ($this->isEditedMessage()) {
            $username = $this->edited_message()->getFrom()->issetUsername() == true ? $this->edited_message()->getFrom()->getUsername() : null;

        }
        if ($this->isEditedChannelPost()) {
            $username = $this->edited_channel_post()->getFrom()->issetUsername() == true ? $this->edited_channel_post()->getFrom()->getUsername() : null;
        }
        $this->caches['username'] = $username;
        return $username;
    }

    public function chatType()
    {
        $type = null;
        if ($this->caches['chatType'] != null) {
            return $this->caches['chatType'];
        }
        if ($this->isMessage()) {
            $type = $this->message()->getChat()->getType();
        }
        if ($this->isCallbackQuery() and $this->callback_query()->issetMessage()) {
            $type = $this->callback_query()->getMessage()->getChat()->getType();
        }
        if ($this->isChannelPost()) {
            $type = $this->channel_post()->getChat()->getType();
        }
        if ($this->isEditedMessage()) {
            $type = $this->edited_message()->getChat()->getType();
        }
        if ($this->isEditedChannelPost()) {
            $type = $this->edited_channel_post()->getChat()->getType();
        }
        $this->caches['chatType'] = $type;
        return $type;
    }

    public function msgType()
    {
        $type = null;
        if ($this->caches['msgType'] != null) {
            return $this->caches['msgType'];
        }
        $type = self::_TEXT;
        if ($this->mediaType()) {
            $type = self::_MEDIA;
        }
        if ($this->message()->issetForwardFrom()) {
            $type = self::_FORWARD;
        }
        $this->caches['msgType'] = $type;
        return $type;
    }

    public function mediaType()
    {
        $type = null;
        if (!$this->isMessage()) {
            return false;
        }
        if ($this->caches['mediaType'] != null) {
            return $this->caches['mediaType'];
        }
        $type = null;
        if ($this->message() && $this->message()->issetText()){
            $type = self::_TEXT;
        }
        if ($this->message()->issetVideo()) {
            $type = self::_VIDEO;
        }
        if ($this->message()->issetPhoto()) {
            $type = self::_PHOTO;
        }
        if ($this->message()->issetAudio()) {
            $type = self::_AUDIO;
        }
        if ($this->message()->issetVoice()) {
            $type = self::_VOICE;
        }
        if ($this->message()->issetAnimation()) {
            $type = self::_ANIMATION;
        }
        if ($this->message()->issetVideoNote()) {
            $type = self::_VIDEO_NOTE;
        }
        if ($this->message()->issetContact()) {
            $type = self::_CONTACT;
        }
        if ($this->message()->issetDocument()) {
            $type = self::_DOCUMENT;
        }
        if ($this->message()->issetSticker()) {
            $type = self::_STICKER;
        }
        if ($this->message()->issetGame()) {
            $type = self::_GAME;
        }
        if ($this->message()->issetLocation()) {
            $type = self::_LOCATION;
        }
        $this->caches['mediaType'] = $type;

        return $type;
    }

    public function fileId()
    {
        if (!$this->isMessage()) {
            return null;
        }
        if ($this->caches['fileId'] != null) {
            return $this->caches['fileId'];
        }
        $id = null;
        if ($this->isDocument()) {
            $id = $this->message()->getDocument()->getFileId();
        }
        if ($this->isAudio()) {
            $id = $this->message()->getAudio()->getFileId();
        }

        if ($this->isPhoto()) {
            $id = $this->message()->getPhoto()[0]->getFileId();
        }

        if ($this->isVideoNote()) {
            $id = $this->message()->getVideoNote()->getFileId();
        }
        if ($this->isVideo()) {
            $id = $this->message()->getVideo()->getFileId();
        }

        if ($this->isVoice()) {
            $id = $this->message()->getVoice()->getFileId();
        }

        if ($this->isSticker()) {
            $id = $this->message()->getSticker()->getFileId();
        }
        if ($this->isAnimation()) {
            $id = $this->message()->getAnimation()->getFileId();
        }
        return $id;
    }

    public function fileSize()
    {
        if (!$this->isMessage()) {
            return null;
        }
        if ($this->caches['filesize'] != null) {
            return $this->caches['filesize'];
        }
        $id = null;
        if ($this->isDocument()) {
            $id = $this->message()->getDocument()->getFileSize();
        }
        if ($this->isAudio()) {
            $id = $this->message()->getAudio()->getFileSize();
        }

        if ($this->isPhoto()) {
            $id = $this->message()->getPhoto()[0]->getFileSize();
        }

        if ($this->isVideoNote()) {
            $id = $this->message()->getVideoNote()->getFileSize();
        }
        if ($this->isVideo()) {
            $id = $this->message()->getVideo()->getFileSize();
        }

        if ($this->isVoice()) {
            $id = $this->message()->getVoice()->getFileSize();
        }

        if ($this->isSticker()) {
            $id = $this->message()->getSticker()->getFileSize();
        }
        if ($this->isAnimation()) {
            $id = $this->message()->getAnimation()->getFileSize();
        }
        return $id;
    }

    public function caption()
    {

        if ($this->caches['caption'] != null) {
            return $this->caches['caption'];
        }

        if ($this->edited_message() && $this->edited_message()->issetCaption()) {
            return $this->edited_message()->getCaption();
        }

        if ($this->edited_channel_post() && $this->edited_channel_post()->issetCaption()) {
            return $this->edited_channel_post()->getCaption();
        }

        if ($this->channel_post() && $this->channel_post()->issetCaption()) {
            return $this->channel_post()->getCaption();
        }

        if ($this->message() && $this->message()->issetCaption()) {
            return $this->message()->getCaption();
        }

        return null;
    }
}
