<?php

namespace Game\Entities;


use Game\Behavioral\MapVisiteeInterface;
use Game\Behavioral\MapVisitorInterface;
use Game\Entities\Earth\EarthInterface;

/**
 * Class Map
 * @package Game\Entities
 */
class Map implements MapInterface, MapVisiteeInterface
{
    /** @var array */
    private $earthData = [];

    /**
     * @param int $x
     * @param int $y
     * @param EarthInterface $earth
     */
    public function setEarth(int $x, int $y, EarthInterface $earth)
    {
        $this->earthData[$x][$y] = $earth;
    }

    /**
     * @param int $x
     * @param int $y
     * @return EarthInterface
     * @throws \Exception
     */
    public function getEarth(int $x, int $y): EarthInterface
    {
        if (isset($this->earthData[$x]) && isset($this->earthData[$x][$y])) {
            return $this->earthData[$x][$y];
        }

        throw new \Exception('Not found earth');
    }

    /**
     * @return array
     */
    public function getAllEarth(): array
    {
        return $this->earthData;
    }

    /**
     * @param MapVisitorInterface $visitorIn
     */
    public function accept(MapVisitorInterface $visitorIn)
    {
        $visitorIn->visitMap($this);
    }
}