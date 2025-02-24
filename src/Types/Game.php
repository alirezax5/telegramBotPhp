<?php

namespace telegramBotApiPhp\Types;

/**
 * Class Game
 * Represents a game. Use BotFather to create and edit games, their short names will act as unique identifiers.
 *
 * @property string $title Title of the game.
 * @property string $description Description of the game.
 * @property PhotoSize[] $photo Photo that will be displayed in the game message in chats.
 * @property string|null $text Optional. Brief description of the game or high scores included in the game message.
 * @property MessageEntity[]|null $text_entities Optional. Special entities that appear in text, such as usernames, URLs, bot commands, etc.
 * @property Animation|null $animation Optional. Animation that will be displayed in the game message in chats. Upload via BotFather.
 */
class Game extends BaseType
{
}
