<?php

namespace Socket\Behavioral;


use Ratchet\ConnectionInterface;

/**
 * Interface HandlerMediatorInterface
 * @package Socket\Behavioral
 */
interface HandlerMediatorInterface
{
    /**
     * @param ConnectionInterface $connection
     */
    public function attach(ConnectionInterface $connection);

    /**
     * @param ConnectionInterface $connection
     */
    public function detach(ConnectionInterface $connection);

    /**
     * @param ConnectionInterface $connection
     * @param $message
     */
    public function onMessage(ConnectionInterface $connection, $message);
}