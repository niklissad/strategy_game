<?php

namespace Game\Entities;


use Game\Behavioral\MessageObserverInterface;
use Game\Enums\CommandEnum;
use Game\Enums\EnumInterface;

/**
 * Class Gamer
 * @package Game\Entities
 */
class Gamer implements GamerInterface
{
    /** @var CommandEnum */
    private $command;
    /** @var string */
    private $name;
    /** @var MessageObserverInterface[] */
    private $observers;

    /**
     * Gamer constructor.
     * @param CommandEnum $command
     */
    public function __construct(CommandEnum $command, string $name)
    {
        $this->command = $command;
        $this->name = $name;
        $this->observers = new \SplObjectStorage();
    }

    /**
     * @return EnumInterface
     */
    public function getCommand(): EnumInterface
    {
        return $this->command;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param MessageObserverInterface $observer
     */
    public function attach(MessageObserverInterface $observer)
    {
        $this->observers->attach($observer);
    }

    /**
     * @param MessageObserverInterface $observer
     */
    public function detach(MessageObserverInterface $observer)
    {
        $this->observers->detach($observer);
    }

    /**
     * @param $message
     */
    public function notify($message)
    {
        foreach ($this->observers as $observer) {
            $observer->message($message);
        }
    }
}