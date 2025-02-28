<?php
namespace telegramBotApiPhp\Requests;

/**
 * Class answerInlineQuery
 * Sends answers to an inline query.
 *
 * @property string $inline_query_id Unique identifier for the answered query
 * @property array $results A JSON-serialized array of results for the inline query
 * @property int|null $cache_time Optional. Max time in seconds that the result may be cached on the server. Defaults to 300.
 * @property bool|null $is_personal Optional. Pass True if results may be cached only for the user that sent the query.
 * @property string|null $next_offset Optional. Offset for the next query with the same text for pagination.
 * @property InlineQueryResultsButton|null $button Optional. A button to be shown above inline query results.
 */
class answerInlineQuery extends BaseRequest
{
}
