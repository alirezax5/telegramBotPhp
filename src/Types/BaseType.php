<?php

namespace telegramBotApiPhp\Types;

use JsonSerializable;
use IteratorAggregate;
use ArrayIterator;

abstract class BaseType implements JsonSerializable, IteratorAggregate
{
    protected array $data = [];

    public function __construct(array|object $data = [])
    {
        $this->data = $this->normalize($data);
    }

    public function getIterator(): \Traversable
    {
        return new ArrayIterator($this->data);
    }

    protected function normalize(array|object $data): array
    {
        if ($data instanceof self) {
            return $data->toArray();
        }

        if (is_object($data)) {
            $data = get_object_vars($data);
        }

        $result = [];

        foreach ($data as $key => $value) {
            if ($value instanceof self) {
                $result[$key] = $value;
                continue;
            }

            if (is_array($value)) {
                if ($this->isAssoc($value)) {
                    $result[$key] = new static($value);
                } else {
                    $items = [];
                    foreach ($value as $item) {
                        if ($item instanceof self) {
                            $items[] = $item;
                        } elseif (is_array($item)) {
                            $items[] = new static($item);
                        } elseif (is_object($item)) {
                            $items[] = new static(get_object_vars($item));
                        } else {
                            $items[] = $item;
                        }
                    }
                    $result[$key] = $items;
                }
                continue;
            }

            if (is_object($value)) {
                $result[$key] = new static(get_object_vars($value));
                continue;
            }

            $result[$key] = $value;
        }

        return $result;
    }

    protected function isAssoc(array $array): bool
    {
        return !array_is_list($array);
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
        return $this->data;
    }

    public function jsonSerialize(): array
    {
        return $this->data;
    }

    public static function create(array|object $data): static
    {
        return new static($data);
    }
}