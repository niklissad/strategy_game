<?php

namespace Game\Dto;

/**
 * Interface DataResponseInterface
 * @package Game\Dto
 */
interface DataResponseInterface
{
    /**
     * @param bool $isStepping
     */
    public function setIsStepping(bool $isStepping);

    /**
     * @return bool
     */
    public function isStepping(): bool;

    /**
     * @param string $message
     */
    public function setMessage(string $message);

    /**
     * @return string
     */
    public function getMessage(): string;
}