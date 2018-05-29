<?php

namespace Game\Entities\Units;


use Game\Entities\Earth\EarthInterface;
use Game\Enums\CommandEnum;
use Game\Enums\EnumInterface;
use Game\Enums\RaceEnum;

/**
 * Class Unit
 * @package Game\Entities\Units
 */
abstract class Unit
{
    /** @var CommandEnum */
    private $command;

    /** @var int */
    protected $life = 0;

    /** @var int */
    protected $damage = 0;

    /** @var EarthInterface */
    protected $earth;

    /** @var RaceEnum */
    protected $race;

    /**
     * Unit constructor.
     * @param CommandEnum $command
     * @param RaceEnum $race
     */
    public function __construct(CommandEnum $command, RaceEnum $race)
    {
        $this->command = $command;
        $this->race = $race;
    }

    /**
     * @return CommandEnum
     */
    public function getCommand(): EnumInterface
    {
        return $this->command;
    }

    /**
     * @return int
     */
    public function getLife(): int
    {
        return $this->life;
    }

    /**
     * @param int $life
     * @throws \Exception
     */
    public function addLife(int $life)
    {
        if ($this->life <= 0) {
            throw new \Exception('Unit is dead');
        }

        $this->life += $life;

        if ($this->life <= 0) {
            $this->detachEarth();
        }
    }

    /**
     *
     */
    protected function detachEarth()
    {
        if ($this->earth) {
            $this->earth->removeEarthUnit();
        }
    }

    /**
     * @return int
     */
    public function getDamage(): int
    {
        return $this->damage;
    }

    /**
     * @param UnitInterface $unit
     * @throws \Exception
     */
    public function attack(UnitInterface $unit)
    {
        if ($this->canAttack($unit)) {
            $unit->addLife($this->getDamage() * -1);

            return;
        }

        throw new \Exception('Can\'t attack');
    }

    /**
     * @param UnitInterface $unit
     * @return bool
     */
    public function canAttack(UnitInterface $unit): bool
    {
        if ($this->getCommand() == $unit->getCommand()) {
            return false;
        }

        return true;
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
            $this->earth->setEarthUnit($this);

            return;
        }

        throw new \Exception('Can\'t attach: ' . get_class($earth));
    }

    /**
     * @param EarthInterface $earth
     * @return bool
     */
    abstract public function canAttachEarth(EarthInterface $earth): bool;

    /**
     * @return bool
     */
    public function canMove(): bool
    {
        return true;
    }

    /**
     * @return RaceEnum
     */
    public function getRace(): EnumInterface
    {
        return $this->race;
    }
}