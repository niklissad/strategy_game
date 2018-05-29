<?php

namespace Socket\Behavioral;


use Game\Behavioral\MessageObserverInterface;
use Game\Entities\GamerInterface;
use Ratchet\ConnectionInterface;

/**
 * Class GamerModel
 * @package Socket\Models
 */
class GamerObserver implements MessageObserverInterface
{
    /** @var GamerInterface */
    private $gamer;
    /** @var ConnectionInterface */
    private $connection;

    /**
     * GamerObserver constructor.
     * @param GamerInterface $gamer
     * @param ConnectionInterface $connection
     */
    public function __construct(GamerInterface $gamer, ConnectionInterface $connection)
    {
        $this->gamer = $gamer;
        $this->connection = $connection;
        $this->gamer->attach($this);
    }

    /**
     * @return GamerInterface
     * @throws \Exception
     */
    public function getGamer(): GamerInterface
    {
        return $this->gamer;
    }

    /**
     * @param object $message
     */
    public function message($message)
    {

        $data = json_encode($message);
        $this->connection->send($data);

    }
}