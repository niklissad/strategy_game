<?php

namespace Game\Entities\Units;


use Game\Entities\Earth\EarthInterface;
use Game\Entities\Earth\SwampInterface;

/**
 * Class Soldier
 * @package Game\Entities\Units
 */
class Soldier extends Unit implements SoldierInterface
{
    /** @var int */
    protected $life = 3;

    /** @var int */
    protected $damage = 1;

    /**
     * @param EarthInterface $earth
     * @return bool
     */
    public function canAttachEarth(EarthInterface $earth): bool
    {
        if ($earth instanceof SwampInterface) {
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

        if ($unit instanceof FighterInterface) {
            return false;
        }

        return true;
    }
}