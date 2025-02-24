<?php

namespace telegramBotApiPhp\Types;

/**
 * Class LinkPreviewOptions
 * Describes the options used for link preview generation.
 *
 * @property bool|null $is_disabled Optional. True if the link preview is disabled.
 * @property string|null $url Optional. URL for the link preview; uses the first URL in text if empty.
 * @property bool|null $prefer_small_media Optional. True to shrink media in the preview (if supported).
 * @property bool|null $prefer_large_media Optional. True to enlarge media in the preview (if supported).
 * @property bool|null $show_above_text Optional. True to show the preview above the message text.
 */
class LinkPreviewOptions extends BaseType
{
}
