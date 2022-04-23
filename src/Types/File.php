<?php


namespace telegramBotApiPhp\Types;

/**
 * Class File
 * @package telegramBotApiPhp\Types
 * @method string getFileId()
 * @method string getFileUniqueId()
 * @method int getFileSize()
 * @method string getFilePath()
 */
class File extends base
{
    static protected $map = [
        'file_id' => true,
        'file_unique_id' => true,
        'file_size' => true,
        'file_path' => true,
    ];
    protected $FileId;
    protected $FileUniqueId;
    protected $FileSize;
    protected $FilePath;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}