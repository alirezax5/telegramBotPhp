<?php


namespace telegramBotApiPhp\Types;


/**
 * Class Voice
 * @package telegramBotApiPhp\Types
 * @method string getUrl()
 * @method boolean getHasCustomCertificate()
 * @method int getPendingUpdateCount()
 * @method string getipAddress()
 * @method string getLastErrorMessage()
 * @method int getLastErrorDate()
 * @method int getLastSynchronizationErrorDate()
 * @method string getMaxConnections()
 * @method array getAllowedUpdates()
 * @method boolean issetUrl()
 * @method boolean issetHasCustomCertificate()
 * @method boolean issetPendingUpdateCount()
 * @method boolean issetipAddress()
 * @method boolean issetLastErrorMessage()
 * @method boolean issetLastErrorDate()
 * @method boolean issetLastSynchronizationErrorDate()
 * @method boolean issetMaxConnections()
 * @method boolean issetAllowedUpdates()
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
        'last_synchronization_error_date' => true,
        'max_connections' => true,
        'allowed_updates' => true,
    ];

    protected $Url;
    protected $HasCustomCertificate;
    protected $PendingUpdateCount;
    protected $ipAddress;
    protected $LastErrorMessage;
    protected $LastErrorDate;
    protected $LastSynchronizationErrorDate;
    protected $MaxConnections;
    protected $AllowedUpdates;


    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}