<?php

namespace Game\Creational;


use Game\Entities\Units\CommandCenter;
use Game\Entities\Units\Fighter;
use Game\Entities\Units\Soldier;
use Game\Entities\Units\Tank;
use Game\Enums\CommandEnum;
use Game\Enums\RaceEnum;

/**
 * Class UnitsAbstractFactory
 * @package Game
 */
abstract class UnitsAbstractFactory
{
    /** @var CommandEnum */
    protected $command;
    /** @var RaceEnum */
    protected $race;

    /**
     * UnitsAbstractFactory constructor.
     * @param CommandEnum $command
     */
    public function __construct(CommandEnum $command)
    {
        $this->command = $command;
    }

    /**
     * @return Fighter
     */
    public function createFighter(): Fighter
    {
        return new Fighter($this->command, $this->race);
    }

    /**
     * @return Tank
     */
    public function createTank(): Tank
    {
        return new Tank($this->command, $this->race);
    }

    /**
     * @return Soldier
     */
    public function createSoldier(): Soldier
    {
        return new Soldier($this->command, $this->race);
    }

    /**
     * @return CommandCenter
     */
    public function createCommandCenter(): CommandCenter
    {
        return new CommandCenter($this->command, $this->race);
    }
}