<?php

namespace Socket;


use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Socket\Behavioral\HandlerMediatorInterface;

/**
 * Class GameHandler
 * @package Socket
 */
class GameHandler implements MessageComponentInterface
{
    /** @var HandlerMediatorInterface */
    private $handlerMediator;

    /**
     * GameHandler constructor.
     * @param HandlerMediatorInterface $handlerMediator
     */
    public function __construct(HandlerMediatorInterface $handlerMediator)
    {
        $this->handlerMediator = $handlerMediator;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->handlerMediator->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";

    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        echo $msg . "\n";
        $this->handlerMediator->onMessage($from, $msg);
    }

    public function onClose(ConnectionInterface $conn)
    {
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }


}

