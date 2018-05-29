<?php

namespace Game\Entities\Units;


use Game\Entities\Earth\EarthInterface;
use Game\Entities\Earth\LandInterface;

/**
 * Class CommandCenter
 * @package Game\Entities\Units
 */
class CommandCenter extends Unit implements CommandCenterInterface
{
    /** @var int */
    protected $life = 10;

    /** @var int */
    protected $damage = 1;


    /**
     * @param EarthInterface $earth
     * @return bool
     */
    public function canAttachEarth(EarthInterface $earth): bool
    {
        if ($earth instanceof LandInterface && !$this->earth) {
            return true;
        }

        return false;
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

        return true;
    }

    /**
     * @return bool
     */
    public function canMove(): bool
    {
        return false;
    }
}