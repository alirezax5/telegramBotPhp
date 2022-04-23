<?php


namespace telegramBotApiPhp\Types;

/**
 * Class ChatInviteLink
 * @package telegramBotApiPhp\Types
 * @method string getInviteLink;()
 * @method User getCreator()
 * @method bool getIsPrimary()
 * @method bool getIsRevoked()
 * @method int getExpireDate()
 * @method int getMemberLimit()
 * @method bool issetInviteLink;()
 * @method bool issetCreator()
 * @method bool issetIsPrimary()
 * @method bool issetIsRevoked()
 * @method bool issetExpireDate()
 * @method bool issetMemberLimit()
 */
class ChatInviteLink extends base
{
    static protected $map = [
        'invite_link' => true,
        'creator' => User::class,
        'is_primary' => true,
        'is_revoked' => true,
        'expire_date' => true,
        'member_limit' => true,
    ];
    protected $InviteLink;
    protected $Creator;
    protected $IsPrimary;
    protected $IsRevoked;
    protected $ExpireDate;
    protected $MemberLimit;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}