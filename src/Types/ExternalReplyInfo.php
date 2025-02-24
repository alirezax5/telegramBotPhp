<?php

namespace telegramBotApiPhp\Types;

/**
 * Class ExternalReplyInfo
 * This object contains information about a message that is being replied to, which may come from another chat or forum topic.
 *
 * @property MessageOrigin $origin Origin of the message replied to.
 * @property Chat|null $chat Optional. Chat the original message belongs to (only for supergroups or channels).
 * @property int|null $message_id Optional. Unique message ID in the original chat (only for supergroups or channels).
 * @property LinkPreviewOptions|null $link_preview_options Optional. Link preview options for the original text message.
 * @property Animation|null $animation Optional. Animation message details.
 * @property Audio|null $audio Optional. Audio file message details.
 * @property Document|null $document Optional. General file message details.
 * @property PaidMediaInfo|null $paid_media Optional. Paid media message details.
 * @property PhotoSize[]|null $photo Optional. Available sizes of the photo message.
 * @property Sticker|null $sticker Optional. Sticker message details.
 * @property Story|null $story Optional. Forwarded story details.
 * @property Video|null $video Optional. Video message details.
 * @property VideoNote|null $video_note Optional. Video note message details.
 * @property Voice|null $voice Optional. Voice message details.
 * @property bool|null $has_media_spoiler Optional. True if media is covered by a spoiler.
 * @property Contact|null $contact Optional. Shared contact details.
 * @property Dice|null $dice Optional. Dice roll message details.
 * @property Game|null $game Optional. Game message details.
 * @property Giveaway|null $giveaway Optional. Scheduled giveaway details.
 * @property GiveawayWinners|null $giveaway_winners Optional. Completed giveaway with public winners.
 * @property Invoice|null $invoice Optional. Payment invoice message details.
 * @property Location|null $location Optional. Shared location details.
 * @property Poll|null $poll Optional. Poll message details.
 * @property Venue|null $venue Optional. Venue message details.
 */
class ExternalReplyInfo extends BaseType
{
}
