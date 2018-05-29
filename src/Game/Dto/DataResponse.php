<?php

namespace Game\Dto;


class DataResponse implements DataResponseInterface
{
    /** @var string */
    private $message;
    /** @var bool */
    private $isStepping;

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return bool
     */
    public function isStepping(): bool
    {
        return $this->isStepping;
    }

    /**
     * @param bool $isStepping
     */
    public function setIsStepping(bool $isStepping): void
    {
        $this->isStepping = $isStepping;
    }
}