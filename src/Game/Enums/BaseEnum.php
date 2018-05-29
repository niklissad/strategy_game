<?php

namespace Game\Enums;


/**
 * Class
 */
abstract class BaseEnum implements EnumInterface
{
    /** @var  string */
    protected $value = '';

    /**
     * BaseEnum constructor.
     * @param string $value
     * @throws \Exception
     * @throws \ReflectionException
     */
    public function __construct(string $value)
    {
        if (!in_array($value, $this->getList())) {
            throw new \Exception('Incorrect enum value' . $value);
        }

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return string[]
     * @throws \ReflectionException
     */
    public static function getList(): array
    {
        $reflectionClass = new \ReflectionClass(static::class);
        return $reflectionClass->getConstants();
    }
}