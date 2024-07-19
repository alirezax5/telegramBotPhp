<?php


namespace telegramBotApiPhp\Types;

/**
 * Class Chat
 * @package telegramBotApiPhp\Types
 * @method int getId()
 * @method string getType()
 * @method string getTitle()
 * @method string getFastName()
 * @method string getLastName()
 * @method string getUsername()
 * @method bool getIsForum()
 * @method ChatPhoto getPhoto()
 * @method array getActiveUsernames()
 * @method ArrayOfReactiontype getAvailableReactions()
 * @method string getDescription()
 * @method string getInviteLink()
 * @method message getPinnedMessage()
 * @method string getStickerSetName()
 * @method bool getCanSetStickerSet()
 * @method string getBackgroundCustomEmojiId()
 * @method int getProfileAccentColorId()
 * @method string getBio()
 * @method int getAccentColorId()
 * @method bool getHasPrivateForwards()
 * @method bool getHasVisibleHistory()
 * @method bool getHasRestrictedVoiceAndVideoMessages()
 * @method bool getJoinToSendMessages()
 * @method bool getJoinByRequest()
 * @method bool getHasProtectedContent()
 * @method bool getIsAutomaticForward()
 * @method Permissions getPermissions()
 * @method int getSlowModeDelay()
 * @method int getMessageAutoDeleteTime()
 * @method bool getHasAggressiveAntiSpamEnabled()
 * @method bool getHasHiddenMembers()
 * @method int getLinkedChatId()
 * @method bool issetId()
 * @method bool issetType()
 * @method bool issetTitle()
 * @method bool issetFastName()
 * @method bool issetLastName()
 * @method bool issetUsername()
 * @method bool issetIsForum()
 * @method bool issetPhoto()
 * @method bool issetActiveUsernames()
 * @method bool issetAvailableReactions()
 * @method bool issetDescription()
 * @method bool issetInviteLink()
 * @method bool issetPinnedMessage()
 * @method bool issetStickerSetName()
 * @method bool issetCanSetStickerSet()
 * @method bool issetAccentColorId()
 * @method bool issetBackgroundCustomEmojiId()
 * @method bool issetProfileAccentColorId()
 * @method bool issetBio()
 * @method bool issetHasPrivateForwards()
 * @method bool issetHasVisibleHistory()
 * @method bool issetHasRestrictedVoiceAndVideoMessages()
 * @method bool issetJoinToSendMessages()
 * @method bool issetJoinByRequest()
 * @method bool issetHasProtectedContent()
 * @method bool issetIsAutomaticForward()
 * @method bool issetPermissions()
 * @method bool issetSlowModeDelay()
 * @method bool issetMessageAutoDeleteTime()
 * @method bool issetHasAggressiveAntiSpamEnabled()
 * @method bool issetHasHiddenMembers()
 * @method bool issetLinkedChatId()
 * @method bool issetLocation()
 */
class Chat extends base
{
    static protected $map = [
        'id' => true,
        'type' => true,
        'title' => true,
        'username' => true,
        'first_name' => true,
        'last_name' => true,
        'is_forum' => true,
        'photo' => ChatPhoto::class,
        'active_usernames' => true,
        'available_reactions' => ArrayOfReactiontype::class,
        'accent_color_id' => true,
        'background_custom_emoji_id' => true,
        'profile_accent_color_id' => true,
        'bio' => true,
        'has_private_forwards' => true,
        'has_restricted_voice_and_video_messages' => true,
        'join_to_send_messages' => true,
        'join_by_request' => true,
        'has_protected_content' => true,
        'has_visible_history' => true,
        'is_automatic_forward' => true,
        'description' => true,
        'invite_link' => true,
        'pinned_message' => Message::class,
        'permissions' => Permissions::class,
        'slow_mode_delay' => true,
        'message_auto_delete_time' => true,
        'has_aggressive_anti_spam_enabled' => true,
        'has_hidden_members' => true,
        'sticker_set_name' => true,
        'can_set_sticker_set' => true,
        'linked_chat_id' => true,
        'location' => ChatLocation::class
    ];
    protected $Id;
    protected $Type;
    protected $Title;
    protected $FirstName;
    protected $LastName;
    protected $Username;
    protected $IsForum;
    protected $Photo;
    protected $ActiveUsernames;
    protected $AvailableReactions;
    protected $Description;
    protected $InviteLink;
    protected $PinnedMessage;
    protected $StickerSetName;
    protected $CanSetStickerSet;
    protected $AccentColorId;
    protected $BackgroundCustomEmojiId;
    protected $ProfileAccentColorId;
    protected $Bio;
    protected $HasPrivateForwards;
    protected $HasRestrictedVoiceAndVideoMessages;
    protected $JoinToSendMessages;
    protected $JoinByRequest;
    protected $HasProtectedContent;
    protected $HasVisibleHistory;
    protected $IsAutomaticForward;
    protected $Permissions;
    protected $SlowModeDelay;
    protected $MessageAutoDeleteTime;
    protected $HasAggressiveAntiSpamEnabled;
    protected $HasHiddenMembers;
    protected $LinkedChatId;
    protected $Location;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }

}