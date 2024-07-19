<?php


namespace telegramBotApiPhp\Types;

/**
 * Class Forumtopiccreated
 * @package telegramBotApiPhp\Types
 * @method string getName()
 * @method int getIconColor()
 * @method string getIconCustomEmojiId()
 * @method bool issetName()
 * @method bool issetIconColor()
 * @method bool issetIconCustomEmojiId()
 */
class Forumtopiccreated extends base
{
    static protected $map = [
        'name' => true,
        'icon_color' => true,
        'icon_custom_emoji_id' => true,

    ];
    protected $Name;
    protected $IconColor;
    protected $IconCustomEmojiId;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}