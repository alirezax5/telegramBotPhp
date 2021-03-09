<?php


namespace telegramBotApiPhp\Types;


/**
 * Class Voice
 * @package telegramBotApiPhp\Types
 * @method string getUrl()
 * @method bool getHasCustomCertificate()
 * @method int getPendingUpdateCount()
 * @method string getipAddress()
 * @method string getLastErrorMessage()
 * @method int getLastErrorDate()
 * @method string getMaxConnections()
 * @method array getAllowedUpdates()
 */
class WebhookInfo extends base
{
    static protected $map = [
        'url' => true,
        'has_custom_certificate' => true,
        'pending_update_count' => true,
        'ip_address' => true,
        'last_error_message' => true,
        'last_error_date' => true,
        'max_connections' => true,
        'allowed_updates' => true,
    ];

    protected $Url;
    protected $HasCustomCertificate;
    protected $PendingUpdateCount;
    protected $ipAddress;
    protected $LastErrorMessage;
    protected $LastErrorDate;
    protected $MaxConnections;
    protected $AllowedUpdates;


    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}