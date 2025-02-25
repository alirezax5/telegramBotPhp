<?php
namespace telegramBotApiPhp\Types;

/**
 * Class WriteAccessAllowed
 * Represents a service message about a user allowing a bot to write messages after adding it to the attachment menu, launching a Web App from a link, or accepting an explicit request from a Web App sent by the method requestWriteAccess.
 *
 * @property bool|null $from_request Optional. True if the access was granted after the user accepted an explicit request from a Web App sent by the method requestWriteAccess.
 * @property string|null $web_app_name Optional. Name of the Web App, if the access was granted when the Web App was launched from a link.
 * @property bool|null $from_attachment_menu Optional. True if the access was granted when the bot was added to the attachment or side menu.
 */
class WriteAccessAllowed extends BaseType
{
}
