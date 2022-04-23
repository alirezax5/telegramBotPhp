<?php


namespace telegramBotApiPhp\Types;


abstract class base
{
    protected static $map = [];

    protected static function toCamelCase($str)
    {
        return str_replace(" ", "", ucwords(str_replace("_", " ", $str)));
    }

    public function map($data)
    {
        foreach (static::$map as $key => $item) {
            if (isset($data[$key]) && (!is_array($data[$key]) || (is_array($data[$key]) && !empty($data[$key])))) {
                try {
                    $method = self::toCamelCase($key);
                    if ($item === true) {
                        $this->init($method, $data[$key]);
                    } else {
                        $this->init($method, $item::create($data[$key]));
                    }
                } catch (Exception $e) {
                    error_log($e);
                }

            }
        }
    }

    public function __call($name, $arg)
    {
        $type = substr($name, 0, 3);
        if (strpos($name, 'isset') !== false) {
            $type = 'isset';
        }
        $method = str_replace($type, '', $name);
    

        if (property_exists($this, $method)) {
            if ($type == 'get' and $this->$method) {
                return $this->$method;
            }
            if ($type == 'set') {
                $this->$method = $arg;
            }
            if ($type == 'isset') {
                return isset($this->$method);
            }
        }
    }

    public static function create($data)
    {
        if ($data === true) {
            return true;
        }

        $instance = new static();
        $instance->map($data);

        return $instance;
    }


}