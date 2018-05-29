<?php

namespace Game\Behavioral\EventHandleChainOfResponsibility;

use Game\Dto\HandlerDataInterface;

/**
 * Class StepHandler
 * @package Game\Behavioral\EventHandleChainOfResponsibility
 */
class StepHandler extends Handler
{
    /**
     * @param HandlerDataInterface $handlerData
     * @param \Closure $callback
     */
    public function handle(HandlerDataInterface $handlerData, \Closure $callback)
    {
        if ($handlerData->getCommandStepping() != $handlerData->getEvent()->getGamer()->getCommand()) {
            $handlerData->getDataResponse()->setMessage('Зараз ходить суперник');
            $handlerData->getDataResponse()->setIsStepping(false);

            $callback($handlerData);

            return;
        }

        $this->next->handle($handlerData, $callback);
    }


}