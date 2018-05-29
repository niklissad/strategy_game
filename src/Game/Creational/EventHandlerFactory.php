<?php

namespace Game\Creational;

use Game\Behavioral\EventHandleChainOfResponsibility\AttackHandler;
use Game\Behavioral\EventHandleChainOfResponsibility\CanAttackHandler;
use Game\Behavioral\EventHandleChainOfResponsibility\CanMoveHandler;
use Game\Behavioral\EventHandleChainOfResponsibility\CheckUnitHandler;
use Game\Behavioral\EventHandleChainOfResponsibility\HandlerInterface;
use Game\Behavioral\EventHandleChainOfResponsibility\MoveHandler;
use Game\Behavioral\EventHandleChainOfResponsibility\StepHandler;

/**
 * Class EventHandlerFactory
 * @package Game\Creational
 */
class EventHandlerFactory
{
    /** @var DtoFactory */
    private $dtoFactory;

    /**
     * EventHandlerFactory constructor.
     * @param DtoFactory $dtoFactory
     */
    public function __construct(DtoFactory $dtoFactory)
    {
        $this->dtoFactory = $dtoFactory;
    }

    /**
     * @return HandlerInterface
     */
    public function createMoveHandler(): HandlerInterface
    {
        $step = new StepHandler();
        $checkUnit = new CheckUnitHandler();
        $canMove = new CanMoveHandler();
        $move = new MoveHandler();

        $step->next($checkUnit);
        $checkUnit->next($canMove);
        $canMove->next($move);

        return $step;
    }

    /**
     * @return HandlerInterface
     */
    public function createAttackHandler(): HandlerInterface
    {
        $step = new StepHandler($this->dtoFactory);
        $checkUnit = new CheckUnitHandler($this->dtoFactory);
        $canAttack = new CanAttackHandler($this->dtoFactory);
        $attack = new AttackHandler($this->dtoFactory);

        $step->next($checkUnit);
        $checkUnit->next($canAttack);
        $canAttack->next($attack);

        return $step;
    }
}