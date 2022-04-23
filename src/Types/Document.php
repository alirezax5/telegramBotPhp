<?php


namespace telegramBotApiPhp\Types;

/**
 * Class Document
 * @package telegramBotApiPhp\Types
 * @method string getFileId()
 * @method string getFileUniqueId()
 * @method PhotoSize getThumb()
 * @method string getFileName()
 * @method string getMimeType()
 * @method int getFileSize()
 */
class Document extends base
{
    static protected $map = [
        'file_id' => true,
        'file_unique_id' => true,
        'thumb' => PhotoSize::class,
        'file_name' => true,
        'mime_type' => true,
        'file_size' => true
    ];
    protected $FileId;
    protected $FileUniqueId;
    protected $FileName;
    protected $Thumb;
    protected $MimeType;
    protected $FileSize;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}