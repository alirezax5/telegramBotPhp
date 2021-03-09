<?php


namespace telegramBotApiPhp\Types;

/**
 * Class ChatMemberUpdated
 * @package telegramBotApiPhp\Types
 * @method Chat getChat()
 * @method User getFrom()
 * @method int getDate()
 * @method ChatMember getOldChatMember()
 * @method ChatMember getNewChatMember()
 * @method ChatInviteLink getInviteLink()
 * @method bool issetChat()
 * @method bool issetFrom()
 * @method bool issetDate()
 * @method bool issetOldChatMember()
 * @method bool issetNewChatMember()
 * @method bool issetInviteLink()
 */
class ChatMemberUpdated extends base
{
    static protected $map = [
        'chat' => Chat::class,
        'from' => User::class,
        'date' => true,
        'old_chat_member' => ChatMember::class,
        'new_chat_member' => ChatMember::class,
        'invite_link' => ChatInviteLink::class,
    ];
    protected $Chat;
    protected $From;
    protected $Date;
    protected $OldChatMember;
    protected $NewChatMember;
    protected $InviteLink;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}
