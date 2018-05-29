<?php

namespace Game\Creational;


use Game\Entities\Earth\Hill;
use Game\Entities\Earth\Land;
use Game\Entities\Earth\Swamp;
use Game\Entities\Earth\Water;
use Game\Entities\Map;
use Game\Enums\CommandEnum;


/**
 * Class MapBuilder
 * @package Game\Creational
 */
class MapBuilder
{
    /** @var Map */
    private $map;

    /** @var int */
    private $widthMap = 7;
    /** @var int */
    private $heightMap = 7;

    /** @var CossacksUnitsFactory */
    private $cossacksUnitsFactory;
    /** @var VikingsUnitsFactory */
    private $vikingsUnitsFactory;

    /**
     * @var array
     */
    private $coordinatesForLand = [
        1 => [3, 4, 5],
        2 => [3, 4, 5],
        6 => [3, 4, 5],
        7 => [3, 4, 5],
    ];

    /**
     * MapBuilder constructor.
     * @param CommandEnum $command1
     * @param CommandEnum $command2
     * @throws \Exception
     * @throws \ReflectionException
     */
    public function __construct(CommandEnum $command1, CommandEnum $command2)
    {
        $this->map = new Map();
        $this->makeMap();
        $this->cossacksUnitsFactory = new CossacksUnitsFactory($command2);
        $this->vikingsUnitsFactory = new VikingsUnitsFactory($command1);
    }

    /**
     * @return Hill
     */
    private function makeHill(): Hill
    {
        return new Hill();
    }

    /**
     * @return Land
     */
    private function makeLand(): Land
    {
        return new Land();
    }

    /**
     * @return Swamp
     */
    private function makeSwamp(): Swamp
    {
        return new Swamp();
    }

    /**
     * @return Water
     */
    private function makeWater(): Water
    {
        return new Water();
    }

    /**
     *
     */
    public function makeMap()
    {
        for ($x = 1; $x <= $this->widthMap; $x++) {
            for ($y = 1; $y <= $this->heightMap; $y++) {
                if (isset($this->coordinatesForLand[$x]) && in_array($y, $this->coordinatesForLand[$x])) {
                    $this->map->setEarth($x, $y, $this->makeLand());
                } else {
                    switch (rand(1, 5)) {
                        case 1:
                        case 2:
                            $earth = $this->makeLand();
                            break;
                        case 3:
                            $earth = $this->makeHill();
                            break;
                        case 4:
                            $earth = $this->makeSwamp();
                            break;
                        case 5:
                            $earth = $this->makeWater();
                            break;
                    }

                    $this->map->setEarth($x, $y, $earth);
                }
            }
        }
    }

    /**
     * @return Map
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * @throws \Exception
     */
    public function setLeftUnits()
    {
        $this->vikingsUnitsFactory->createTank()->attachEarth($this->map->getEarth(1, 3));
        $this->vikingsUnitsFactory->createCommandCenter()->attachEarth($this->map->getEarth(1, 4));
        $this->vikingsUnitsFactory->createFighter()->attachEarth($this->map->getEarth(1, 4));
        $this->vikingsUnitsFactory->createTank()->attachEarth($this->map->getEarth(1, 5));

        $this->vikingsUnitsFactory->createSoldier()->attachEarth($this->map->getEarth(2, 3));
        $this->vikingsUnitsFactory->createSoldier()->attachEarth($this->map->getEarth(2, 4));
        $this->vikingsUnitsFactory->createSoldier()->attachEarth($this->map->getEarth(2, 5));
    }

    /**
     * @throws \Exception
     */
    public function setRightUnits()
    {
        $this->cossacksUnitsFactory->createTank()->attachEarth($this->map->getEarth(7, 3));
        $this->cossacksUnitsFactory->createCommandCenter()->attachEarth($this->map->getEarth(7, 4));
        $this->cossacksUnitsFactory->createFighter()->attachEarth($this->map->getEarth(7, 4));
        $this->cossacksUnitsFactory->createTank()->attachEarth($this->map->getEarth(7, 5));

        $this->cossacksUnitsFactory->createSoldier()->attachEarth($this->map->getEarth(6, 3));
        $this->cossacksUnitsFactory->createSoldier()->attachEarth($this->map->getEarth(6, 4));
        $this->cossacksUnitsFactory->createSoldier()->attachEarth($this->map->getEarth(6, 5));
    }

}