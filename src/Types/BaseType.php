<?php

namespace telegramBotApiPhp\Types;

use JsonSerializable;

/**
 * Class BaseType
 * کلاس پایه برای تمام انواع آپدیت‌های تلگرام.
 */
abstract class BaseType implements JsonSerializable
{
    protected array $data;

    public function __construct(array $data = [])
    {
        $this->data = $this->mapToObjects($data);
    }

   
    protected function mapToObjects(array $data): array
    {
        foreach ($data as $key => $value) {
            if (is_array($value) && $this->isAssocArray($value)) {
                $data[$key] = new static($value);
            } elseif (is_array($value)) {
                $data[$key] = array_map(fn($item) => is_array($item) ? new static($item) : $item, $value);
            }
        }
        return $data;
    }


    protected function isAssocArray(array $array): bool
    {
        return array_keys($array) !== range(0, count($array) - 1);
    }

    public function __get(string $name)
    {
        return $this->data[$name] ?? null;
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public static function create(array $data): static
    {
        return new static($data);
    }
}
