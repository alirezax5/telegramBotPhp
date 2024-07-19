<?php


namespace telegramBotApiPhp\Types;

/**
 * Class Reactiontype
 * @package telegramBotApiPhp\Types
 * @method string getType()
 * @method string getEmoji()
 * @method string getCustomEmojiId()
 * @method string getTotalCount()
 * @method bool issetType()
 * @method bool issetEmoji()
 * @method bool issetCustomEmojiId()
 * @method bool issetTotalCount()

 */
class Reactiontype extends base
{
    static protected $map = [
        'type' => true,
        'emoji' => true,
        'custom_emoji_id' => true,
        'total_count' => true
    ];
    protected $Type;
    protected $Emoji;
    protected $CustomEmojiId;
    protected $TotalCount;


    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}