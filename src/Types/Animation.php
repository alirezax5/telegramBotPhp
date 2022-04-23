<?php


namespace telegramBotApiPhp\Types;

/**
 * Class Animation
 * @package telegramBotApiPhp\Types
 * @method string getFileId()
 * @method string getFileUniqueId()
 * @method int getWidth()
 * @method int getHeight()
 * @method int getDuration()
 * @method PhotoSize getThumb()
 * @method string getFileName()
 * @method string getMimeType()
 * @method int getFileSize()
 */
class Animation extends base
{
    static protected $map = [
        'file_id' => true,
        'file_unique_id' => true,
        'width' => true,
        'height' => true,
        'duration' => true,
        'thumb' => PhotoSize::class,
        'file_name' => true,
        'mime_type' => true,
        'file_size' => true
    ];
    protected $FileId;
    protected $FileUniqueId;
    protected $Width;
    protected $Height;
    protected $Duration;
    protected $Thumb;
    protected $FileName;
    protected $MimeType;
    protected $FileSize;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}