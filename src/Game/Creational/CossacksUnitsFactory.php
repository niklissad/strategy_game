<?php

namespace Game\Creational;


use Game\Enums\CommandEnum;
use Game\Enums\RaceEnum;

/**
 * Class CossacksUnitsFactory
 * @package Game\Creational
 */
class CossacksUnitsFactory extends UnitsAbstractFactory
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
        $this->race = new RaceEnum(RaceEnum::COSSACKS);
    }
}