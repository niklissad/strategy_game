<?php

namespace Socket\Behavioral;


use Ratchet\ConnectionInterface;

/**
 * Interface GameMediatorInterface
 * @package Socket\Behavioral
 */
interface GameMediatorInterface
{
    /**
     * @param ConnectionInterface $connection
     * @param $message
     * @return mixed
     */
    public function onMessage(ConnectionInterface $connection, $message);
}