<?php

namespace Game\Dto;

/**
 * Class CoordinateDto
 * @package Game\Events
 */
class Coordinate implements CoordinateInterface
{
    /** @var int */
    private $x;
    /** @var int */
    private $y;
    /** @var bool */
    private $fly;

    /**
     * CoordinateDto constructor.
     * @param int $x
     * @param int $y
     * @param bool $fly
     */
    public function __construct(int $x, int $y, bool $fly = false)
    {
        $this->x = $x;
        $this->y = $y;
        $this->fly = $fly;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @return bool
     */
    public function isFly(): bool
    {
        return $this->fly;
    }

}