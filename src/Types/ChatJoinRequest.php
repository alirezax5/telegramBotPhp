<?php


namespace telegramBotApiPhp\Types;

/**
 * Class ChatPhoto
 * @package telegramBotApiPhp\Types
 * @method getChat()
 * @method getFrom()
 * @method getDate()
 * @method getBio()
 * @method getInviteLink()
 * @method isseChat()
 * @method isseFrom()
 * @method isseDate()
 * @method isseBio()
 * @method isseInviteLink()
 */
class ChatJoinRequest extends base
{
    static protected $map = [
        'chat' => Chat::class,
        'from' => User::class,
        'date' => true,
        'bio' => true,
        'invite_link' => ChatInviteLink::class,
    ];
    protected $Chat;
    protected $From;
    protected $Date;
    protected $Bio;
    protected $InviteLink;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}