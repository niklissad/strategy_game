<?php

namespace Game\Behavioral\EventHandleChainOfResponsibility;

use Game\Dto\HandlerDataInterface;

/**
 * Interface HandlerInterface
 * @package Game\Behavioral\ChainOfResponsibility
 */
interface HandlerInterface
{
    /**
     * @param HandlerInterface $eventHandler
     */
    public function next(HandlerInterface $eventHandler);

    /**
     * @param HandlerDataInterface $handlerData
     * @param \Closure $callback
     */
    public function handle(HandlerDataInterface $handlerData, \Closure $callback);
}