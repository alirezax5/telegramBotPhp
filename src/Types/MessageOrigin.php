<?php


namespace telegramBotApiPhp\Types;

/**
 * Class MessageOrigin
 * @package telegramBotApiPhp\Types
 * @method string getType()
 * @method int getDate()
 * @method User getSenderUser()
 * @method string getSenderUserName()
 * @method Chat getSenderChat()
 * @method string getAuthorSignature()
 * @method int getMessageId()
 * @method bool issetType()
 * @method bool issetDate()
 * @method bool issetSenderUser()
 * @method bool issetSenderUserName()
 * @method bool issetSenderChat()
 * @method bool issetAuthorSignature()
 * @method bool issetMessageId()
 */
class MessageOrigin extends base
{
    static protected $map = [
        'type' => true,
        'date' => true,
        'sender_user' => User::class,
        'sender_user_name' => true,
        'sender_chat' => Chat::class,
        'author_signature' => true,
        'message_id' => true,

    ];
    protected $Type;
    protected $Date;
    protected $SenderUser;
    protected $SenderUserName;
    protected $SenderChat;
    protected $AuthorSignature;
    protected $MessageId;


    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}