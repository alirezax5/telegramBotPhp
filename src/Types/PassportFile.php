<?php


namespace telegramBotApiPhp\Types;

/**
 * Class PassportFile
 * @package telegramBotApiPhp\Types
 * @method string getFileId()
 * @method string getFileUniqueId()
 * @method int getFileSize()
 * @method int getFileDate()
 */
class PassportFile extends base
{
    static protected $map = [
        'file_id' => true,
        'file_unique_id' => true,
        'file_size' => true,
        'file_date' => true,
    ];
    protected $FileId;
    protected $FileUniqueId;
    protected $FileSize;
    protected $FileDate;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}