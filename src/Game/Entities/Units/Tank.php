<?php

namespace Game\Entities\Units;


use Game\Entities\Earth\EarthInterface;
use Game\Entities\Earth\HillInterface;
use Game\Entities\Earth\WaterInterface;

/**
 * Class Tank
 * @package Game\Entities\Units
 */
class Tank extends Unit implements TankInterface
{
    /** @var int */
    protected $life = 6;

    /** @var int */
    protected $damage = 2;

    /**
     * @param EarthInterface $earth
     * @return bool
     */
    public function canAttachEarth(EarthInterface $earth): bool
    {
        if ($earth instanceof HillInterface || $earth instanceof WaterInterface) {
            return false;
        }

        return true;
    }

    /**
     * @param UnitInterface $unit
     * @return bool
     */
    public function canAttack(UnitInterface $unit): bool
    {
        if (!parent::canAttack($unit)) {
            return false;
        }

        if ($unit instanceof FlyUnitInterface) {
            return false;
        }

        return true;
    }
}