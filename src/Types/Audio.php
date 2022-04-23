<?php


namespace telegramBotApiPhp\Types;


/**
 * Class Audio
 * @package telegramBotApiPhp\Types
 * @method string getFileId()
 * @method string getFileUniqueId()
 * @method int getDuration()
 * @method string getPerformer()
 * @method string getTitle()
 * @method string getFileName()
 * @method string getMimeType()
 * @method int getFileSize()
 * @method PhotoSize getThumb()
 */
class Audio extends base
{
    static protected $map = [
        'file_id' => true,
        'file_unique_id' => true,
        'duration' => true,
        'performer' => true,
        'title' => true,
        'file_name' => true,
        'mime_type' => true,
        'file_size' => true,
        'thumb' => true
    ];
    protected $FileId;
    protected $FileUniqueId;
    protected $Duration;
    protected $Performer;
    protected $Title;
    protected $FileName;
    protected $MimeType;
    protected $FileSize;
    protected $Thumb;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}