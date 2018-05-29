<?php

namespace Game\Entities\Earth;


use Game\Entities\Units\EarthUnitInterface;
use Game\Entities\Units\FlyUnitInterface;

/**
 * Class Earth
 * @package Game\Entities\Earth
 */
abstract class Earth
{
    /** @var FlyUnitInterface */
    protected $flyUnit;
    /** @var EarthUnitInterface */
    protected $earthUnit;

    /**
     * @param FlyUnitInterface $flyUnit
     */
    public function setFlyUnit(FlyUnitInterface $flyUnit)
    {
        $this->flyUnit = $flyUnit;
    }

    /**
     * @param EarthUnitInterface $earthUnit
     */
    public function setEarthUnit(EarthUnitInterface $earthUnit)
    {
        $this->earthUnit = $earthUnit;
    }

    /**
     * @return FlyUnitInterface
     */
    public function getFlyUnit(): FlyUnitInterface
    {
        return $this->flyUnit;
    }

    /**
     * @return EarthUnitInterface
     */
    public function getEarthUnit(): EarthUnitInterface
    {
        return $this->earthUnit;
    }


    /**
     *
     */
    public function removeFlyUnit()
    {
        $this->flyUnit = null;
    }

    /**
     *
     */
    public function removeEarthUnit()
    {
        $this->earthUnit = null;
    }

    /**
     * @return bool
     */
    public function hasFlyUnit(): bool
    {
        return (bool)$this->flyUnit;
    }

    /**
     * @return bool
     */
    public function hasEarthUnit(): bool
    {
        return (bool)$this->earthUnit;
    }
}