<?php

namespace Game\Creational;

use Game\BattleManager;
use Game\BattleManagerInterface;
use Game\Behavioral\MapVisitor;
use Game\Entities\Gamer;
use Game\Enums\CommandEnum;

/**
 * Class BattleManagerFactoryStaticMethod
 * @package Game
 */
class BattleManagerFactoryMethod
{
    /**
     * @return BattleManagerInterface
     * @throws \Exception
     * @throws \ReflectionException
     */
    public function createBattleManager(): BattleManagerInterface
    {
        $command1 = new CommandEnum(CommandEnum::BLUE);
        $command2 = new CommandEnum(CommandEnum::RED);

        $gamer1 = new Gamer($command1, 'Gamer 1');
        $gamer2 = new Gamer($command2, 'Gamer 2');

        $mapBuilder = new MapBuilder($command1, $command2);
        $mapBuilder->makeMap();
        $mapBuilder->setRightUnits();
        $mapBuilder->setLeftUnits();
        $map = $mapBuilder->getMap();

        $dtoFactory = new DtoFactory();
        $mapVisitor = new MapVisitor($dtoFactory);

        $eventHandlerFactory = new EventHandlerFactory($dtoFactory);

        $manager = new BattleManager($map,
            $gamer1,
            $gamer2,
            $dtoFactory,
            $mapVisitor,
            $eventHandlerFactory
        );

        return $manager;
    }

    /**
     * @return BattleManagerFactoryMethod
     */
    public static function factory(): self
    {
        return new self();
    }
}