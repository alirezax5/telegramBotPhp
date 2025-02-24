<?php

namespace telegramBotApiPhp\Types;

use JsonSerializable;

/**
 * Class BaseType
 * کلاس پایه برای تمام انواع آپدیت‌های تلگرام.
 */
abstract class BaseType implements JsonSerializable
{
    /**
     * داده‌های کلاس که به‌صورت داینامیک تنظیم می‌شوند.
     * @var array
     */
    protected array $data;

    /**
     * مقداردهی اولیه کلاس با داده‌های آپدیت.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * متد جادویی برای دریافت متغیرهای داینامیک.
     * اگر مقدار وجود نداشته باشد، مقدار `null` برمی‌گرداند.
     *
     * @param string $name نام متغیر
     * @return mixed|null مقدار متغیر یا null در صورت عدم وجود
     */
    public function __get(string $name)
    {
        return $this->data[$name] ?? null;
    }

    /**
     * بررسی می‌کند که مقدار خاصی در داده‌های کلاس وجود دارد یا خیر.
     *
     * @param string $key نام کلید
     * @return bool
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->data) && !is_null($this->data[$key]);
    }

    /**
     * تبدیل داده‌های کلاس به آرایه.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
     * تبدیل داده‌های کلاس به JSON.
     *
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    /**
     * متد مخصوص `json_encode()` در PHP.
     * هنگام `json_encode($object)`, مقدار `toArray()` را برمی‌گرداند.
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * متد استاتیک برای ایجاد نمونه‌ای از کلاس.
     *
     * @param array $data
     * @return static
     */
    public static function create(array $data): static
    {
        return new static($data);
    }
}
