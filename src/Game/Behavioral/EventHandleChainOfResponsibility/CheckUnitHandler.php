<?php

namespace Game\Behavioral\EventHandleChainOfResponsibility;

use Game\Dto\HandlerDataInterface;

/**
 * Class CheckUnitHandler
 * @package Game\Behavioral\EventHandleChainOfResponsibility
 */
class CheckUnitHandler extends Handler
{
    /**
     * @param HandlerDataInterface $handlerData
     * @param \Closure $callback
     */
    public function handle(HandlerDataInterface $handlerData, \Closure $callback)
    {
        $earth = $handlerData->getMap()->getEarth(
            $handlerData->getEvent()->getCoordinateFrom()->getX(),
            $handlerData->getEvent()->getCoordinateFrom()->getY()
        );

        if ($handlerData->getEvent()->getCoordinateFrom()->isFly()) {
            $unit = $earth->getFlyUnit();
        } else {
            $unit = $earth->getEarthUnit();
        }

        if ($unit->getCommand() != $handlerData->getEvent()->getGamer()->getCommand()) {
            $handlerData->getDataResponse()->setMessage('Ви не можете ходити чужими юнітами');
            $handlerData->getDataResponse()->setIsStepping(false);

            $callback($handlerData);

            return;
        }

        $this->next->handle($handlerData, $callback);
    }


}