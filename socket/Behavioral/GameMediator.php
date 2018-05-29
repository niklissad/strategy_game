<?php

namespace Socket\Behavioral;


use Game\BattleManagerInterface;
use Game\Creational\BattleManagerFactoryMethod;
use Game\Dto\Coordinate;
use Game\Entities\GamerInterface;
use Game\Events\AttackEvent;
use Game\Events\MoveEvent;
use Ratchet\ConnectionInterface;

/**
 * Class GameModel
 * @package Socket\Models
 */
class GameMediator implements GameMediatorInterface
{
    /** @var ConnectionInterface */
    private $connection1;
    /** @var ConnectionInterface */
    private $connection2;

    /** @var GamerObserver */
    private $gamer1;
    /** @var GamerObserver */
    private $gamer2;

    /** @var BattleManagerInterface */
    private $battleManager;

    /**
     * GameModel constructor.
     * @param ConnectionInterface $connection1
     * @param ConnectionInterface $connection2
     * @throws \Exception
     * @throws \ReflectionException
     */
    public function __construct(ConnectionInterface $connection1, ConnectionInterface $connection2)
    {
        $this->connection1 = $connection1;
        $this->connection2 = $connection2;

        $this->init();
    }

    /**
     * @throws \Exception
     * @throws \ReflectionException
     */
    private function init()
    {
        $this->battleManager = $this->battleManagerFactory();

        $this->gamer1 = $this->gamerObserverFactory($this->battleManager->getGamer1(), $this->connection1);
        $this->gamer2 = $this->gamerObserverFactory($this->battleManager->getGamer2(), $this->connection2);

        $this->battleManager->init();
    }

    /**
     * @param ConnectionInterface $connection
     * @param $message
     * @return mixed|void
     * @throws \Exception
     */
    public function onMessage(ConnectionInterface $connection, $message)
    {
        $data = json_decode($message);

        if ($this->connection1 === $connection) {
            $gamer = $this->gamer1;
        } elseif ($this->connection2 === $connection) {
            $gamer = $this->gamer2;
        } else {
            throw new \Exception('Bad connection');
        }

        $coordinate1 = new Coordinate($data->from->x, $data->from->y, $data->from->fly);
        $coordinate2 = new Coordinate($data->to->x, $data->to->y, $data->to->fly);

        if ($data->action == 'attack') {
            $event = new AttackEvent($coordinate1, $coordinate2, $gamer->getGamer());
        } else {
            $event = new MoveEvent($coordinate1, $coordinate2, $gamer->getGamer());
        }

        $this->battleManager->triggerEvent($event);
    }


    /**
     * @throws \Exception
     * @throws \ReflectionException
     */
    private function battleManagerFactory(): BattleManagerInterface
    {
        return BattleManagerFactoryMethod::factory()->createBattleManager();
    }

    /**
     * @param GamerInterface $gamer
     * @param ConnectionInterface $connection
     * @return GamerObserver
     */
    private function gamerObserverFactory(GamerInterface $gamer, ConnectionInterface $connection): GamerObserver
    {
        return new GamerObserver($gamer, $connection);
    }
}