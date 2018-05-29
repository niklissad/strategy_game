<?php

namespace Game;


use Game\Behavioral\EventHandleChainOfResponsibility\HandlerInterface;
use Game\Behavioral\MessageSubjectInterface;
use Game\Behavioral\MapVisiteeInterface;
use Game\Behavioral\MapVisitor;
use Game\Creational\DtoFactory;
use Game\Creational\EventHandlerFactory;
use Game\Dto\HandlerDataInterface;
use Game\Entities\Gamer;
use Game\Entities\MapInterface;
use Game\Events\AttackEventInterface;
use Game\Events\EventInterface;
use Game\Events\MoveEventInterface;

/**
 * Class BattleManager
 * @package Game
 */
class BattleManager implements BattleManagerInterface
{
    /** @var MapInterface */
    private $map;
    /** @var Gamer */
    private $gamer1;
    /** @var Gamer */
    private $gamer2;
    /** @var DtoFactory */
    private $dtoFactory;
    /** @var MapVisitor */
    private $mapVisitor;
    /** @var EventHandlerFactory */
    private $eventHandlerFactory;

    /** @var HandlerInterface */
    private $moveHandler;
    /** @var HandlerInterface */
    private $attackHandler;

    /** @var Gamer */
    private $currentGamerStep;

    /**
     * BattleManager constructor.
     * @param MapInterface $map
     * @param MessageSubjectInterface $gamer1
     * @param MessageSubjectInterface $gamer2
     * @param DtoFactory $dtoFactory
     * @param MapVisitor $mapVisitor
     * @param EventHandlerFactory $eventHandlerFactory
     * @throws \Exception
     */
    public function __construct(
        MapInterface $map,
        MessageSubjectInterface $gamer1,
        MessageSubjectInterface $gamer2,
        DtoFactory $dtoFactory,
        MapVisitor $mapVisitor,
        EventHandlerFactory $eventHandlerFactory
    )
    {
        $this->map = $map;
        $this->gamer1 = $gamer1;
        $this->gamer2 = $gamer2;
        $this->dtoFactory = $dtoFactory;
        $this->mapVisitor = $mapVisitor;
        $this->eventHandlerFactory = $eventHandlerFactory;

        $this->moveHandler = $this->eventHandlerFactory->createMoveHandler();
        $this->attackHandler = $this->eventHandlerFactory->createAttackHandler();

        if (!$this->map instanceof MapVisiteeInterface) {
            throw new \Exception('Bad instance of map');
        }

        $this->map->accept($this->mapVisitor);

        $this->currentGamerStep = $this->gamer1;
    }

    /**
     * @throws \Exception
     */
    public function init()
    {
        $blocks = $this->mapVisitor->getMapBlocksInformation();

        $message = $this->dtoFactory->createMessage();
        $message->message = 'Ви за синіх';
        $message->isStep = true;
        $message->blocks = $blocks;
        $this->gamer1->notify($message);

        $message = $this->dtoFactory->createMessage();
        $message->message = 'Ви за червоних';
        $message->isStep = false;
        $message->blocks = $blocks;
        $this->gamer2->notify($message);
    }

    /**
     * @return MapInterface
     */
    public function getMap(): MapInterface
    {
        return $this->map;
    }

    /**
     * @return Gamer
     */
    public function getGamer1(): Gamer
    {
        return $this->gamer1;
    }

    /**
     * @return Gamer
     */
    public function getGamer2(): Gamer
    {
        return $this->gamer2;
    }

    /**
     * @param EventInterface $event
     * @throws \Exception
     */
    public function triggerEvent(EventInterface $event)
    {
        $data = $this->dtoFactory->createHandlerData();
        $data->setCommandStepping($this->currentGamerStep->getCommand());
        $data->setEvent($event);
        $data->setMap($this->map);

        $callback = function (HandlerDataInterface $handlerData) {
            $blocks = $this->mapVisitor->getMapBlocksInformation();

            if ($handlerData->getDataResponse()->isStepping()) {
                if ($handlerData->getEvent()->getGamer() == $this->gamer1) {
                    $this->currentGamerStep = $this->gamer2;
                } else {
                    $this->currentGamerStep = $this->gamer1;
                }

                $message = $this->dtoFactory->createMessage();
                $message->message = 'Суперник походив';
                $message->isStep = true;
                $message->blocks = $blocks;

                $this->currentGamerStep->notify($message);
            }

            $message = $this->dtoFactory->createMessage();
            $message->message = $handlerData->getDataResponse()->getMessage();
            $message->isStep = $handlerData->getEvent()->getGamer() == $this->currentGamerStep;
            $message->blocks = $blocks;

            $handlerData->getEvent()->getGamer()->notify($message);
        };

        if ($event instanceof MoveEventInterface) {
            $this->moveHandler->handle($data, $callback);
        } elseif ($event instanceof AttackEventInterface) {
            $this->attackHandler->handle($data, $callback);
        } else {
            throw new \Exception('Bad instance of event');
        }
    }
}