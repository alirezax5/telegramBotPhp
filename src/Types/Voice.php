<?php


namespace telegramBotApiPhp\Types;

/**
 * Class Voice
 * @package telegramBotApiPhp\Types
 * @method string getFileId()
 * @method string getFileUniqueId()
 * @method int getDuration()
 * @method string getMimeType()
 * @method int getFileSize()
 */
class Voice extends base
{
    static protected $map = [
        'file_id' => true,
        'file_unique_id' => true,
        'duration' => true,
        'mime_type' => true,
        'file_size' => true
    ];

    protected $FileId;
    protected $FileUniqueId;
    protected $Duration;
    protected $MimeType;
    protected $FileSize;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}