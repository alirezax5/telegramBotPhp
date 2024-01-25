<?php


namespace telegramBotApiPhp\Types;

use telegramBotApiPhp\Types\base;

/**
 * Class message
 * @package telegramBotApiPhp\Types
 * @method int getDate()
 * @method string getText()
 * @method int getMessageId()
 * @method User getFrom()
 * @method Chat getChat()
 * @method User getForwardFrom()
 * @method Chat getForwardFromChat()
 * @method int getForwardFromMessageId()
 * @method int getForwardDate()
 * @method string getForwardSignature()
 * @method string getForwardSenderName()
 * @method Message getReplyToMessage()
 * @method MessageOrigin getForwardOrigin()
 * @method bool getIsTopicMessage()
 * @method bool getIsAautomaticForward()
 * @method int getEditDate()
 * @method int getMediaGroupId()
 * @method bool getHasProtectedContent()
 * @method string getAuthorSignature()
 * @method Chat getSenderChat()
 * @method User getViaBot()
 * @method ArrayOfMessageEntity getEntities()
 * @method Animation getAnimation()
 * @method Audio getAudio()
 * @method Document getDocument()
 * @method ArrayOfPhotoSize getPhoto()
 * @method Sticker getSticker()
 * @method Video getVideo()
 * @method VideoNote getVideoNote()
 * @method Voice getVoice()
 * @method string getCaption()
 * @method ArrayOfMessageEntity getCaptionEntities()
 * @method ArrayOfMessageEntity getHasMediaSpoiler()
 * @method Contact getContact()
 * @method Dice getDice()
 * @method Game getGame()
 * @method Poll getPoll()
 * @method Venue getVenue()
 * @method Location getLocation()
 * @method ArrayOfUser getNewChatMembers()
 * @method User getLeftChatMember()
 * @method string getNewChatTitle()
 * @method PhotoSize getNewChatPhoto()
 * @method bool getDeleteChatPhoto()
 * @method bool getGroupChatCreated()
 * @method bool getSupergroupChatCreated()
 * @method bool getChannelChatCreated()
 * @method int getMigrateToChatId()
 * @method MessageAutoDeleteTimerChanged getMessageAutoDeleteTimerChanged()
 * @method int getMigrateFromChatId()
 * @method Message getPinnedMessage()
 * @method Invoice getInvoice()
 * @method SuccessfulPayment getSuccessfulPayment()
 * @method string getConnectedWebsite()
 * @method PassportData getPassportData()
 * @method ProximityAlertTriggered getProximityAlertTriggered()
 * @method VideoChatStarted getVideoChatStarted()
 * @method VideoChatEnded getVideoChatEnded()
 * @method VideoChatScheduled getVideoChatScheduled()
 * @method VideoChatParticipantsInvited getVideoChatParticipantsInvited()
 * @method WebAppData getWebAppData()
 * @method bool issetDate()
 * @method bool issetText()
 * @method bool issetMessageId()
 * @method bool issetFrom()
 * @method bool issetChat()
 * @method bool issetForwardFrom()
 * @method bool issetForwardFromChat()
 * @method bool issetForwardFromMessageId()
 * @method bool issetForwardDate()
 * @method bool issetForwardSignature()
 * @method bool issetForwardSenderName()
 * @method bool issetForwardOrigin()
 * @method bool issetIsTopicMessage()
 * @method bool issetIsAautomaticForward()
 * @method bool issetReplyToMessage()
 * @method bool issetEditDate()
 * @method bool issetMediaGroupId()
 * @method bool issetHasProtectedContent()
 * @method bool issetAuthorSignature()
 * @method bool issetSenderChat()
 * @method bool issetViaBot()
 * @method bool issetEntities()
 * @method bool issetAnimation()
 * @method bool issetAudio()
 * @method bool issetDocument()
 * @method bool issetPhoto()
 * @method bool issetSticker()
 * @method bool issetVideo()
 * @method bool issetVideoNote()
 * @method bool issetVoice()
 * @method bool issetCaption()
 * @method bool issetCaptionEntities()
 * @method bool issetHasMediaSpoiler()
 * @method bool issetContact()
 * @method bool issetDice()
 * @method bool issetGame()
 * @method bool issetPoll()
 * @method bool issetVenue()
 * @method bool issetLocation()
 * @method bool issetNewChatMembers()
 * @method bool issetLeftChatMember()
 * @method bool issetNewChatTitle()
 * @method bool issetNewChatPhoto()
 * @method bool issetDeleteChatPhoto()
 * @method bool issetGroupChatCreated()
 * @method bool issetSupergroupChatCreated()
 * @method bool issetChannelChatCreated()
 * @method bool issetMigrateToChatId()
 * @method bool issetMessageAutoDeleteTimerChanged()
 * @method bool issetMigrateFromChatId()
 * @method bool issetPinnedMessage()
 * @method bool issetInvoice()
 * @method bool issetSuccessfulPayment()
 * @method bool issetConnectedWebsite()
 * @method bool issetPassportData()
 * @method bool issetProximityAlertTriggered()
 * @method bool issetVideoChatStarted()
 * @method bool issetVideoChatEnded()
 * @method bool issetVideoChatScheduled()
 * @method bool issetVideoChatParticipantsInvited()
 * @method bool issetWebAppData()
 */
class Message extends base
{
    static protected $map = [
        'message_id' => true,
        'date' => true,
        'text' => true,
        'from' => User::class,
        'chat' => Chat::class,
        'forward_from' => User::class,
        'forward_from_chat' => Chat::class,
        'forward_from_message_id' => true,
        'forward_date' => true,
        'forward_signature' => true,
        'forward_sender_name' => true,
        'forward_origin' => MessageOrigin::class,
        'is_topic_message' => true,
        'is_automatic_forward' => true,
        'reply_to_message' => Message::class,
        'edit_date' => true,
        'media_group_id' => true,
        'has_protected_content' => true,
        'author_signature' => true,
        'sender_chat' => Chat::class,
        'via_bot' => User::class,
        'entities' => ArrayOfMessageEntity::class,
        'animation' => Animation::class,
        'audio' => Audio::class,
        'document' => Document::class,
        'photo' => ArrayOfPhotoSize::class,
        'sticker' => Sticker::class,
        'video' => Video::class,
        'video_note' => VideoNote::class,
        'voice' => Voice::class,
        'caption' => true,
        'caption_entities' => ArrayOfMessageEntity::class,
        'has_media_spoiler' => true,
        'contact' => Contact::class,
        'dice' => Dice::class,
        'game' => Game::class,
        'poll' => Poll::class,
        'venue' => Venue::class,
        'location' => Location::class,
        'new_chat_members' => ArrayOfUser::class,
        'left_chat_member' => User::class,
        'new_chat_title' => true,
        'new_chat_photo' => ArrayOfPhotoSize::class,
        'delete_chat_photo' => true,
        'group_chat_created' => true,
        'supergroup_chat_created' => true,
        'channel_chat_created' => true,
        'migrate_to_chat_id' => true,
        'message_auto_delete_timer_changed' => MessageAutoDeleteTimerChanged::class,
        'migrate_from_chat_id' => true,
        'pinned_message' => Message::class,
        'invoice' => Invoice::class,
        'successful_payment' => SuccessfulPayment::class,
        'connected_website' => true,
        'passport_data' => PassportData::class,
        'proximity_alert_triggered' => ProximityAlertTriggered::class,
        'video_chat_started' => VideoChatStarted::class,
        'video_chat_ended' => VideoChatEnded::class,
        'video_chat_scheduled' => VideoChatScheduled::class,
        'web_app_data' => WebAppData::class,
        'video_chat_participants_invited' => VideoChatParticipantsInvited::class,
    ];

    protected $MessageId;
    protected $Text;
    protected $Date;
    protected $From;
    protected $SenderChat;
    protected $Chat;
    protected $ForwardFrom;
    protected $ForwardFromChat;
    protected $ForwardFromMessageId;
    protected $ForwardDate;
    protected $ForwardSignature;
    protected $ForwardSenderName;
    protected $ForwardOrigin;
    protected $IsTopicMessage;
    protected $IsAautomaticForward;
    protected $ReplyToMessage;
    protected $EditDate;
    protected $MediaGroupId;
    protected $HasProtectedContent;
    protected $AuthorSignature;
    protected $ViaBot;
    protected $Entities;
    protected $Animation;
    protected $Audio;
    protected $Document;
    protected $Photo;
    protected $Sticker;
    protected $Video;
    protected $VideoNote;
    protected $Voice;
    protected $Caption;
    protected $CaptionEntities;
    protected $HasMediaSpoiler;
    protected $Contact;
    protected $Dice;
    protected $Game;
    protected $Poll;
    protected $Venue;
    protected $Location;
    protected $NewChatMembers;
    protected $LeftChatMember;
    protected $NewChatTitle;
    protected $NewChatPhoto;
    protected $DeleteChatPhoto;
    protected $GroupChatCreated;
    protected $SupergroupChatCreated;
    protected $ChannelChatCreated;
    protected $MigrateToChatId;
    protected $MessageAutoDeleteTimerChanged;
    protected $MigrateFromChatId;
    protected $PinnedMessage;
    protected $Invoice;
    protected $SuccessfulPayment;
    protected $ConnectedWebsite;
    protected $PassportData;
    protected $ProximityAlertTriggered;
    protected $VideoChatStarted;
    protected $VideoChatEnded;
    protected $VideoChatScheduled;
    protected $VideoChatParticipantsInvited;
    protected $WebAppData;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}