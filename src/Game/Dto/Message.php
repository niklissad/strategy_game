<?php

namespace Game\Dto;

/**
 * Class Message
 * @package Game\Dto
 */
class Message
{
    /** @var string */
    public $message;
    /** @var Block[] */
    public $blocks = [];
    /** @var bool */
    public $isStep = false;
}