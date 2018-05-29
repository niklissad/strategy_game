<?php

namespace Game\Entities\Units;


use Game\Entities\Earth\EarthInterface;

/**
 * Class Fighter
 * @package Game\Entities\Units
 */
class Fighter extends Unit implements FighterInterface
{
    /** @var int */
    protected $life = 6;

    /** @var int */
    protected $damage = 1;

    /**
     *
     */
    protected function detachEarth()
    {
        if (!$this->earth) {
            return;
        }

        $this->earth->removeFlyUnit();
    }

    /**
     * @param EarthInterface $earth
     * @throws \Exception
     */
    public function attachEarth(EarthInterface $earth)
    {
        if ($this->canAttachEarth($earth)) {
            $this->detachEarth();
            $this->earth = $earth;
            $this->earth->setFlyUnit($this);

            return;
        }

        throw new \Exception('Can\'t attach: ' . get_class($earth));
    }

    /**
     * @param EarthInterface $earth
     * @return bool
     */
    public function canAttachEarth(EarthInterface $earth): bool
    {
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

        if ($unit instanceof TankInterface || $unit instanceof CommandCenterInterface) {
            return true;
        }

        return false;
    }


}