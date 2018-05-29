<?php

namespace Game;


use Game\Entities\Gamer;
use Game\Entities\MapInterface;
use Game\Events\EventInterface;

/**
 * Interface BattleManagerInterface
 * @package Game
 */
interface BattleManagerInterface
{
    /**
     *
     */
    public function init();

    /**
     * @return MapInterface
     */
    public function getMap(): MapInterface;

    /**
     * @return Gamer
     */
    public function getGamer1(): Gamer;

    /**
     * @return Gamer
     */
    public function getGamer2(): Gamer;

    /**
     * @param EventInterface $event
     */
    public function triggerEvent(EventInterface $event);
}