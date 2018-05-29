<?php

namespace Game\Entities\Earth;


use Game\Entities\Units\EarthUnitInterface;
use Game\Entities\Units\FlyUnitInterface;

/**
 * Interface EarthInterface
 * @package Game\Entities\Earth
 */
interface EarthInterface
{
    /**
     * @param FlyUnitInterface $flyUnit
     */
    public function setFlyUnit(FlyUnitInterface $flyUnit);

    /**
     * @param EarthUnitInterface $earthUnit
     */
    public function setEarthUnit(EarthUnitInterface $earthUnit);

    /**
     * @return FlyUnitInterface
     */
    public function getFlyUnit(): FlyUnitInterface;

    /**
     * @return EarthUnitInterface
     */
    public function getEarthUnit(): EarthUnitInterface;

    /**
     */
    public function removeFlyUnit();

    /**
     */
    public function removeEarthUnit();

    /**
     * @return bool
     */
    public function hasFlyUnit(): bool;

    /**
     * @return bool
     */
    public function hasEarthUnit(): bool;

}