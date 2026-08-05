<?php

declare(strict_types=1);

namespace telegramBotApiPhp\Traits;

use telegramBotApiPhp\Types\{
    returnedArrayOfSticker, returnedFile, returnedMessage, returnedStickerSet,
};

trait Stickers
{


    /**
     * @return returnedMessage
     */
    public function sendSticker($chat_id, $sticker, array $options = []): returnedMessage
    {

        $data = compact('chat_id', 'sticker') + $options;

        return returnedMessage::create($this->call('sendSticker', $data));
    }


    /**
     * @return returnedStickerSet
     */
    public function getStickerSet($name, array $options = []): returnedStickerSet
    {

        $data = compact('name') + $options;

        return returnedStickerSet::create($this->call('getStickerSet', $data));
    }


    /**
     * @return returnedArrayOfSticker
     */
    public function getCustomEmojiStickers($custom_emoji_ids, array $options = []): returnedArrayOfSticker
    {

        $data = compact('custom_emoji_ids') + $options;

        return returnedArrayOfSticker::create($this->call('getCustomEmojiStickers', $data));
    }


    /**
     * @return returnedFile
     */
    public function uploadStickerFile($user_id, $sticker, $sticker_format, array $options = []): returnedFile
    {

        $data = compact('user_id', 'sticker', 'sticker_format') + $options;

        return returnedFile::create($this->call('uploadStickerFile', $data));
    }


    /**
     * @return returned
     */
    public function createNewStickerSet($user_id, $name, $title, $stickers, array $options = []): returned
    {

        $data = compact('user_id', 'name', 'title', 'stickers') + $options;

        return returned::create($this->call('createNewStickerSet', $data));
    }


    /**
     * @return returned
     */
    public function addStickerToSet($user_id, $name, $title, $sticker, array $options = []): returned
    {

        $data = compact('user_id', 'name', 'sticker') + $options;

        return returned::create($this->call('addStickerToSet', $data));
    }


    /**
     * @return returned
     */
    public function setStickerPositionInSet(string $sticker, int $position, array $options = []): returned
    {

        $data = compact('sticker', 'position') + $options;

        return returned::create($this->call('setStickerPositionInSet', $data));
    }


    /**
     * @return returned
     */
    public function deleteStickerFromSet(string $sticker, array $options = []): returned
    {

        $data = compact('sticker') + $options;

        return returned::create($this->call('deleteStickerFromSet', $data));
    }


    /**
     * @return returned
     */
    public function replaceStickerInSet($user_id, $name, $old_sticker, $sticker, array $options = []): returned
    {

        $data = compact('user_id', 'name', 'old_sticker', 'sticker') + $options;

        return returned::create($this->call('replaceStickerInSet', $data));
    }


    /**
     * @return returned
     */
    public function setStickerEmojiList($sticker, $emoji_list, array $options = []): returned
    {

        $data = compact('sticker', 'emoji_list') + $options;

        return returned::create($this->call('setStickerEmojiList', $data));
    }


    /**
     * @return returned
     */
    public function setStickerKeywords($sticker, $keywords = [], array $options = []): returned
    {

        $data = compact('sticker', 'keywords') + $options;

        return returned::create($this->call('setStickerKeywords', $data));
    }


    /**
     * @return returned
     */
    public function setStickerMaskPosition($sticker, array $options = []): returned
    {

        $data = compact('sticker') + $options;

        return returned::create($this->call('setStickerMaskPosition', $data));
    }


    /**
     * @return returned
     */
    public function setStickerSetTitle($name, $title, array $options = []): returned
    {

        $data = compact('name', 'title') + $options;

        return returned::create($this->call('setStickerSetTitle', $data));
    }


    /**
     * @return returned
     */
    public function setStickerSetThumbnail($name, $user_id, $format, array $options = []): returned
    {

        $data = compact('name', 'user_id', 'format') + $options;

        return returned::create($this->call('setStickerSetThumbnail', $data));
    }


    /**
     * @return returned
     */
    public function setCustomEmojiStickerSetThumbnail($name, array $options = []): returned
    {

        $data = compact('name') + $options;

        return returned::create($this->call('setCustomEmojiStickerSetThumbnail', $data));
    }


    /**
     * @return returned
     */
    public function deleteStickerSet($name, array $options = []): returned
    {

        $data = compact('name') + $options;

        return returned::create($this->call('deleteStickerSet', $data));
    }
}
