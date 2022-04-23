<?php


namespace telegramBotApiPhp\Types;

/**
 * Class Game
 * @package telegramBotApiPhp\Types
 * @method string geTitle()
 * @method string geDescription()
 * @method array gePhoto()
 * @method string geText()
 * @method array geTextEntities()
 * @method Animation geAnimation()
 */
class Game extends base
{
    static protected $map = [
        'title' => true,
        'description' => true,
        'photo' => ArrayOfPhotoSize::class,
        'text' => true,
        'text_entities' => ArrayOfMessageEntity::class,
        'animation' => Animation::class,
    ];

    protected $Title;
    protected $Description;
    protected $Photo;
    protected $Text;
    protected $TextEntities;
    protected $Animation;


    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}