<?php
namespace telegramBotApiPhp\Types;

/**
 * Class MessageId
 * This object represents a unique message identifier.
 *
 * @property string $MessageId Unique message identifier. In specific instances (e.g., message containing a video sent to a big chat), the server might automatically schedule a message instead of sending it immediately. In such cases, this field will be 0 and the relevant message will be unusable until it is actually sent
 */
class MessageId extends BaseType
{
}
