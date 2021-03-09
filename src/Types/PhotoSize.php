<?php


namespace telegramBotApiPhp\Types;

/**
 * Class PhotoSize
 * @package telegramBotApiPhp\Types
 * @method string getFileId()
 * @method string getFileUniqueId()
 * @method int getWidth()
 * @method int getHeight()
 * @method int getFileSize()
 */
class PhotoSize extends base
{
    static protected $map = [
        'file_id' => true,
        'file_unique_id' => true,
        'width' => true,
        'height' => true,
        'file_size' => true,
    ];
    protected $FileId;
    protected $FileUniqueId;
    protected $Width;
    protected $Height;
    protected $FileSize;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}