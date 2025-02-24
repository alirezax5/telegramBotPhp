<?php

namespace telegramBotApiPhp\Types;

/**
 * Class MessageEntity
 * Represents one special entity in a text message. For example, hashtags, usernames, URLs, etc.
 *
 * @property string $type Type of the entity. Currently, can be “mention” (@username), “hashtag” (#hashtag or #hashtag@chatusername), “cashtag” ($USD or $USD@chatusername), “bot_command” (/start@jobs_bot), “url” (https://telegram.org), “email” (do-not-reply@telegram.org), “phone_number” (+1-212-555-0123), “bold” (bold text), “italic” (italic text), “underline” (underlined text), “strikethrough” (strikethrough text), “spoiler” (spoiler message), “blockquote” (block quotation), “expandable_blockquote” (collapsed-by-default block quotation), “code” (monowidth string), “pre” (monowidth block), “text_link” (for clickable text URLs), “text_mention” (for users without usernames), “custom_emoji” (for inline custom emoji stickers).
 * @property int $offset Offset in UTF-16 code units to the start of the entity.
 * @property int $length Length of the entity in UTF-16 code units.
 * @property string|null $url Optional. For “text_link” only, URL that will be opened after user taps on the text.
 * @property User|null $user Optional. For “text_mention” only, the mentioned user.
 * @property string|null $language Optional. For “pre” only, the programming language of the entity text.
 * @property string|null $custom_emoji_id Optional. For “custom_emoji” only, unique identifier of the custom emoji.
 */
class MessageEntity extends BaseType
{
}
