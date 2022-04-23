<?php


namespace telegramBotApiPhp\Types;

/**
 * Class VideoNote
 * @package telegramBotApiPhp\Types
 * @method string getFileId()
 * @method string getFileUniqueId()
 * @method int getLength()
 * @method int getDuration()
 * @method PhotoSize getThumb()
 * @method int getFileSize()
 */
class VideoNote extends base
{
    static protected $map = [
        'file_id' => true,
        'file_unique_id' => true,
        'length' => true,
        'duration' => true,
        'thumb' => PhotoSize::class,
        'file_size' => true
    ];
    protected $FileId;
    protected $FileUniqueId;
    protected $Length;
    protected $Duration;
    protected $Thumb;
    protected $FileSize;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}