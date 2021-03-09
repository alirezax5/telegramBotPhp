<?php


namespace telegramBotApiPhp\Types;

/**
 * Class MaskPosition
 * @package telegramBotApiPhp\Types
 * @method string getPoint()
 * @method float getXShift()
 * @method float getYShift()
 * @method float getScale()
 */
class MaskPosition extends base
{
    static protected $map = [
        'point' => true,
        'x_shift' => true,
        'y_shift' => true,
        'scale' => true,
    ];
    protected $Point;
    protected $XShift;
    protected $YShift;
    protected $Scale;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}