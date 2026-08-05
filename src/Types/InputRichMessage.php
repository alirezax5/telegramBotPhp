<?php

declare(strict_types=1);

namespace telegramBotApiPhp\Types;

/**
 * Class InputRichMessage
 * @package telegramBotApiPhp\Types
 *
 * Describes a rich message to be sent.
 * Exactly one of the fields `html`, `markdown`, or `blocks` must be used.
 *
 * @property array|null $blocks  Content of the rich message described as a list of blocks
 * @property string|null $html    Content of the rich message described using HTML formatting
 * @property string|null $markdown Content of the rich message described using Markdown formatting
 * @property mixed|null  $media   Media used in the message
 */
class InputRichMessage extends BaseType
{

}