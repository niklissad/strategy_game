<?php

namespace Game\Dto;


interface CoordinateInterface
{
    /**
     * @return int
     */
    public function getX(): int;

    /**
     * @return int
     */
    public function getY(): int;

    /**
     * @return bool
     */
    public function isFly(): bool;
}