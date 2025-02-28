<?php
namespace telegramBotApiPhp\Types;

/**
 * Class InlineQueryResult
 * This object represents one result of an inline query.
 *
 * @property string $type Type of the result
 * @property string $id Unique identifier for this result, 1-64 bytes
 * @property string|null $title Optional. Title of the result
 * @property string|null|InputMessageContent $input_message_content Optional. Content of the message to be sent
 * @property InlineKeyboardMarkup|null $reply_markup Optional. Inline keyboard attached to the message
 * @property string|null $url Optional. URL of the result
 * @property string|null $description Optional. Short description of the result
 * @property string|null $thumbnail_url Optional. URL of the thumbnail for the result
 * @property int|null $thumbnail_width Optional. Thumbnail width
 * @property int|null $thumbnail_height Optional. Thumbnail height
 * @property string|null $photo_url Optional. URL of the photo
 * @property int|null $photo_width Optional. Width of the photo
 * @property int|null $photo_height Optional. Height of the photo
 * @property string|null $caption Optional. Caption of the media, 0-1024 characters
 * @property string|null $parse_mode Optional. Mode for parsing entities in the caption
 * @property array|null $caption_entities Optional. List of special entities that appear in the caption
 * @property bool|null $show_caption_above_media Optional. Pass True if the caption must be shown above the media
 * @property string|null $gif_url Optional. URL for the GIF file
 * @property int|null $gif_width Optional. Width of the GIF
 * @property int|null $gif_height Optional. Height of the GIF
 * @property int|null $gif_duration Optional. Duration of the GIF in seconds
 * @property string|null $mpeg4_url Optional. URL for the MPEG4 file
 * @property int|null $mpeg4_width Optional. Video width
 * @property int|null $mpeg4_height Optional. Video height
 * @property int|null $mpeg4_duration Optional. Video duration in seconds
 * @property string|null $video_url Optional. URL for the video
 * @property string|null $mime_type Optional. MIME type of the content
 * @property int|null $video_width Optional. Video width
 * @property int|null $video_height Optional. Video height
 * @property int|null $video_duration Optional. Video duration in seconds
 * @property string|null $audio_url Optional. URL for the audio file
 * @property string|null $performer Optional. Performer of the audio
 * @property int|null $audio_duration Optional. Duration of the audio in seconds
 * @property string|null $voice_url Optional. URL for the voice recording
 * @property int|null $voice_duration Optional. Duration of the voice recording in seconds
 * @property string|null $document_url Optional. URL for the document
 * @property string|null $mime_type_document Optional. MIME type of the document
 * @property string|null $latitude Optional. Latitude of the venue location
 * @property string|null $longitude Optional. Longitude of the venue location
 * @property string|null $address Optional. Address of the venue
 * @property string|null $foursquare_id Optional. Foursquare identifier of the venue
 * @property string|null $foursquare_type Optional. Foursquare type of the venue
 * @property string|null $google_place_id Optional. Google Places identifier of the venue
 * @property string|null $google_place_type Optional. Google Places type of the venue
 * @property string|null $phone_number Optional. Contact's phone number
 * @property string|null $first_name Optional. Contact's first name
 * @property string|null $last_name Optional. Contact's last name
 * @property string|null $vcard Optional. Additional data about the contact in the form of a vCard
 * @property string|null $game_short_name Optional. Short name of the game
 * @property string|null $sticker_file_id Optional. A valid file identifier of the sticker
 * @property string|null $document_file_id Optional. A valid file identifier for the file
 */
class InlineQueryResult extends BaseType
{
}
