<?php

namespace Socket\Behavioral;

use Ratchet\ConnectionInterface;

/**
 * Class HandlerMediator
 * @package Socket
 */
class HandlerMediator implements HandlerMediatorInterface
{
    /** @var ConnectionInterface */
    private $freeConnection;
    /** @var GameMediator[] */
    private $games = [];
    /** @var array */
    private $gamesIdsOfGamers = [];

    /**
     * @param ConnectionInterface $connection
     * @throws \Exception
     * @throws \ReflectionException
     */
    public function attach(ConnectionInterface $connection)
    {
        if (!$this->freeConnection) {
            $this->freeConnection = $connection;

            return;
        }

        $game = $this->gameMediatorFactory($this->freeConnection, $connection);
        $gameId = spl_object_hash($game);
        $this->games[$gameId] = $game;

        $this->gamesIdsOfGamers[$this->freeConnection->resourceId] = $gameId;
        $this->gamesIdsOfGamers[$connection->resourceId] = $gameId;

        $this->freeConnection = null;
    }

    public function detach(ConnectionInterface $connection)
    {


    }

    /**
     * @param ConnectionInterface $connection
     * @param $message
     * @throws \Exception
     */
    public function onMessage(ConnectionInterface $connection, $message)
    {
        $gameModel = $this->games[$this->gamesIdsOfGamers[$connection->resourceId]];

        $gameModel->onMessage($connection, $message);
    }

    /**
     * @param ConnectionInterface $connection1
     * @param ConnectionInterface $connection2
     * @return GameMediator
     * @throws \Exception
     * @throws \ReflectionException
     */
    private function gameMediatorFactory(ConnectionInterface $connection1, ConnectionInterface $connection2): GameMediatorInterface
    {
        return new GameMediator($connection1, $connection2);
    }
}