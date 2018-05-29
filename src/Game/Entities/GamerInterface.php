<?php

namespace Game\Entities;


use Game\Behavioral\MessageSubjectInterface;
use Game\Enums\EnumInterface;

/**
 * Interface GamerInterface
 * @package Game\Entities
 */
interface GamerInterface extends MessageSubjectInterface
{
    /**
     * @return EnumInterface
     */
    public function getCommand(): EnumInterface;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return mixed
     */
    public function setName(string $name);
}