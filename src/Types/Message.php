<?php


namespace telegramBotApiPhp\Types;

use telegramBotApiPhp\Types\base;

/**
 * Class message
 * @package telegramBotApiPhp\Types
 * @method Animation getAnimation()
 * @method ArrayOfMessageEntity getCaptionEntities()
 * @method ArrayOfMessageEntity getEntities()
 * @method ArrayOfMessageEntity getHasMediaSpoiler()
 * @method ArrayOfPhotoSize getPhoto()
 * @method ArrayOfUser getNewChatMembers()
 * @method Audio getAudio()
 * @method Chat getChat()
 * @method Chat getForwardFromChat()
 * @method Chat getSenderChat()
 * @method ChatShared getChatShared()
 * @method Contact getContact()
 * @method Dice getDice()
 * @method Document getDocument()
 * @method Game getGame()
 * @method Invoice getInvoice()
 * @method Location getLocation()
 * @method Message getPinnedMessage()
 * @method Message getReplyToMessage()
 * @method MessageAutoDeleteTimerChanged getMessageAutoDeleteTimerChanged()
 * @method MessageOrigin getForwardOrigin()
 * @method PassportData getPassportData()
 * @method PhotoSize getNewChatPhoto()
 * @method Poll getPoll()
 * @method ProximityAlertTriggered getProximityAlertTriggered()
 * @method Sticker getSticker()
 * @method SuccessfulPayment getSuccessfulPayment()
 * @method User getForwardFrom()
 * @method User getFrom()
 * @method User getLeftChatMember()
 * @method User getViaBot()
 * @method UsersShared getUsersShared()
 * @method Venue getVenue()
 * @method Video getVideo()
 * @method VideoChatEnded getVideoChatEnded()
 * @method VideoChatParticipantsInvited getVideoChatParticipantsInvited()
 * @method VideoChatScheduled getVideoChatScheduled()
 * @method VideoChatStarted getVideoChatStarted()
 * @method VideoNote getVideoNote()
 * @method Voice getVoice()
 * @method WebAppData getWebAppData()
 * @method bool getChannelChatCreated()
 * @method bool getDeleteChatPhoto()
 * @method bool getGroupChatCreated()
 * @method bool getHasProtectedContent()
 * @method bool getIsAautomaticForward()
 * @method bool getIsTopicMessage()
 * @method bool getSupergroupChatCreated()
 * @method int getDate()
 * @method int getEditDate()
 * @method int getForwardDate()
 * @method int getForwardFromMessageId()
 * @method int getMediaGroupId()
 * @method int getMessageId()
 * @method int getMigrateFromChatId()
 * @method int getMigrateToChatId()
 * @method string getAuthorSignature()
 * @method string getCaption()
 * @method string getConnectedWebsite()
 * @method string getForwardSenderName()
 * @method string getForwardSignature()
 * @method string getNewChatTitle()
 * @method string getText()
 * @method bool issetAnimation()
 * @method bool issetAudio()
 * @method bool issetAuthorSignature()
 * @method bool issetCaption()
 * @method bool issetCaptionEntities()
 * @method bool issetChannelChatCreated()
 * @method bool issetChat()
 * @method bool issetChatShared()
 * @method bool issetConnectedWebsite()
 * @method bool issetContact()
 * @method bool issetDate()
 * @method bool issetDeleteChatPhoto()
 * @method bool issetDice()
 * @method bool issetDocument()
 * @method bool issetEditDate()
 * @method bool issetEntities()
 * @method bool issetForwardDate()
 * @method bool issetForwardFrom()
 * @method bool issetForwardFromChat()
 * @method bool issetForwardFromMessageId()
 * @method bool issetForwardOrigin()
 * @method bool issetForwardSenderName()
 * @method bool issetForwardSignature()
 * @method bool issetFrom()
 * @method bool issetGame()
 * @method bool issetGroupChatCreated()
 * @method bool issetHasMediaSpoiler()
 * @method bool issetHasProtectedContent()
 * @method bool issetInvoice()
 * @method bool issetIsAautomaticForward()
 * @method bool issetIsTopicMessage()
 * @method bool issetLeftChatMember()
 * @method bool issetLocation()
 * @method bool issetMediaGroupId()
 * @method bool issetMessageAutoDeleteTimerChanged()
 * @method bool issetMessageId()
 * @method bool issetMigrateFromChatId()
 * @method bool issetMigrateToChatId()
 * @method bool issetNewChatMembers()
 * @method bool issetNewChatPhoto()
 * @method bool issetNewChatTitle()
 * @method bool issetPassportData()
 * @method bool issetPhoto()
 * @method bool issetPinnedMessage()
 * @method bool issetPoll()
 * @method bool issetProximityAlertTriggered()
 * @method bool issetReplyToMessage()
 * @method bool issetSenderChat()
 * @method bool issetSticker()
 * @method bool issetSuccessfulPayment()
 * @method bool issetSupergroupChatCreated()
 * @method bool issetText()
 * @method bool issetUsersShared()
 * @method bool issetVenue()
 * @method bool issetViaBot()
 * @method bool issetVideo()
 * @method bool issetVideoChatEnded()
 * @method bool issetVideoChatParticipantsInvited()
 * @method bool issetVideoChatScheduled()
 * @method bool issetVideoChatStarted()
 * @method bool issetVideoNote()
 * @method bool issetVoice()
 * @method bool issetWebAppData()
 */
class Message extends base
{
    static protected $map = [
        'animation' => Animation::class,
        'audio' => Audio::class,
        'author_signature' => true,
        'caption' => true,
        'caption_entities' => ArrayOfMessageEntity::class,
        'channel_chat_created' => true,
        'chat' => Chat::class,
        'chat_shared' => ChatShared::class,
        'connected_website' => true,
        'contact' => Contact::class,
        'date' => true,
        'delete_chat_photo' => true,
        'dice' => Dice::class,
        'document' => Document::class,
        'edit_date' => true,
        'entities' => ArrayOfMessageEntity::class,
        'forward_date' => true,
        'forward_from' => User::class,
        'forward_from_chat' => Chat::class,
        'forward_from_message_id' => true,
        'forward_origin' => MessageOrigin::class,
        'forward_sender_name' => true,
        'forward_signature' => true,
        'from' => User::class,
        'game' => Game::class,
        'group_chat_created' => true,
        'has_media_spoiler' => true,
        'has_protected_content' => true,
        'invoice' => Invoice::class,
        'is_automatic_forward' => true,
        'is_topic_message' => true,
        'left_chat_member' => User::class,
        'location' => Location::class,
        'media_group_id' => true,
        'message_auto_delete_timer_changed' => MessageAutoDeleteTimerChanged::class,
        'message_id' => true,
        'migrate_from_chat_id' => true,
        'migrate_to_chat_id' => true,
        'new_chat_members' => ArrayOfUser::class,
        'new_chat_photo' => ArrayOfPhotoSize::class,
        'new_chat_title' => true,
        'passport_data' => PassportData::class,
        'photo' => ArrayOfPhotoSize::class,
        'pinned_message' => Message::class,
        'poll' => Poll::class,
        'proximity_alert_triggered' => ProximityAlertTriggered::class,
        'reply_to_message' => Message::class,
        'sender_chat' => Chat::class,
        'sticker' => Sticker::class,
        'successful_payment' => SuccessfulPayment::class,
        'supergroup_chat_created' => true,
        'text' => true,
        'users_shared' => UsersShared::class,
        'venue' => Venue::class,
        'via_bot' => User::class,
        'video' => Video::class,
        'video_chat_ended' => VideoChatEnded::class,
        'video_chat_participants_invited' => VideoChatParticipantsInvited::class,
        'video_chat_scheduled' => VideoChatScheduled::class,
        'video_chat_started' => VideoChatStarted::class,
        'video_note' => VideoNote::class,
        'voice' => Voice::class,
        'web_app_data' => WebAppData::class,
    ];

    protected $Animation;
    protected $Audio;
    protected $AuthorSignature;
    protected $Caption;
    protected $CaptionEntities;
    protected $ChannelChatCreated;
    protected $Chat;
    protected $ChatShared;
    protected $ConnectedWebsite;
    protected $Contact;
    protected $Date;
    protected $DeleteChatPhoto;
    protected $Dice;
    protected $Document;
    protected $EditDate;
    protected $Entities;
    protected $ForwardDate;
    protected $ForwardFrom;
    protected $ForwardFromChat;
    protected $ForwardFromMessageId;
    protected $ForwardOrigin;
    protected $ForwardSenderName;
    protected $ForwardSignature;
    protected $From;
    protected $Game;
    protected $GroupChatCreated;
    protected $HasMediaSpoiler;
    protected $HasProtectedContent;
    protected $Invoice;
    protected $IsAautomaticForward;
    protected $IsTopicMessage;
    protected $LeftChatMember;
    protected $Location;
    protected $MediaGroupId;
    protected $MessageAutoDeleteTimerChanged;
    protected $MessageId;
    protected $MigrateFromChatId;
    protected $MigrateToChatId;
    protected $NewChatMembers;
    protected $NewChatPhoto;
    protected $NewChatTitle;
    protected $PassportData;
    protected $Photo;
    protected $PinnedMessage;
    protected $Poll;
    protected $ProximityAlertTriggered;
    protected $ReplyToMessage;
    protected $SenderChat;
    protected $Sticker;
    protected $SuccessfulPayment;
    protected $SupergroupChatCreated;
    protected $Text;
    protected $UsersShared;
    protected $Venue;
    protected $ViaBot;
    protected $Video;
    protected $VideoChatEnded;
    protected $VideoChatParticipantsInvited;
    protected $VideoChatScheduled;
    protected $VideoChatStarted;
    protected $VideoNote;
    protected $Voice;
    protected $WebAppData;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}