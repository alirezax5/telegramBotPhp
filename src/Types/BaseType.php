<?php

declare(strict_types=1);

namespace telegramBotApiPhp\Types;

use JsonSerializable;
use IteratorAggregate;
use ArrayIterator;

abstract class BaseType implements JsonSerializable, IteratorAggregate
{
    protected array $data = [];

    /**
     * @param array|object $data Raw data from API (stdClass or array)
     */
    public function __construct(array|object $data = [])
    {
        if ($data instanceof self) {
            $this->data = $data->toArray();
        } elseif (is_object($data)) {
            $this->data = get_object_vars($data);
        } else {
            $this->data = $data;
        }
    }

    public function getIterator(): \Traversable
    {
        return new ArrayIterator($this->data);
    }

    public function __get(string $name): mixed
    {
        return $this->data[$name] ?? null;
    }

    public function __isset(string $name): bool
    {
        return isset($this->data[$name]);
    }

    public function toArray(): array
    {
        $result = [];
        foreach ($this->data as $key => $value) {
            if ($value instanceof self) {
                $result[$key] = $value->toArray();
            } elseif (is_array($value)) {
                $result[$key] = array_map(
                    fn($item) => $item instanceof self ? $item->toArray() : $item,
                    $value
                );
            } elseif (is_object($value)) {
                $result[$key] = get_object_vars($value);
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public static function create(array|object $data): static
    {
        return new static($data);
    }
}