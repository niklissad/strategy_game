<?php

namespace Game\Creational;


use Game\Enums\CommandEnum;
use Game\Enums\RaceEnum;

/**
 * Class BlueUnitsFactory
 * @package Game\Creational
 */
class VikingsUnitsFactory extends UnitsAbstractFactory
{
    /**
     * CossacksUnitsFactory constructor.
     * @param CommandEnum $command
     * @throws \Exception
     * @throws \ReflectionException
     */
    public function __construct(CommandEnum $command)
    {
        parent::__construct($command);
        $this->race = new RaceEnum(RaceEnum::VIKINGS);
    }
}