<?php

namespace Game\Behavioral\EventHandleChainOfResponsibility;

use Game\Dto\HandlerDataInterface;

/**
 * Class MoveHandler
 * @package Game\Behavioral\EventHandleChainOfResponsibility
 */
class MoveHandler extends Handler
{
    public function handle(HandlerDataInterface $handlerData, \Closure $callback)
    {
        $earthFrom = $handlerData->getMap()->getEarth(
            $handlerData->getEvent()->getCoordinateFrom()->getX(),
            $handlerData->getEvent()->getCoordinateFrom()->getY()
        );

        if ($handlerData->getEvent()->getCoordinateFrom()->isFly()) {
            $unit = $earthFrom->getFlyUnit();
        } else {
            $unit = $earthFrom->getEarthUnit();
        }

        $earthTo = $handlerData->getMap()->getEarth(
            $handlerData->getEvent()->getCoordinateTo()->getX(),
            $handlerData->getEvent()->getCoordinateTo()->getY()
        );

        $unit->attachEarth($earthTo);


        $handlerData->getDataResponse()->setMessage('Ви походили');
        $handlerData->getDataResponse()->setIsStepping(true);

        $callback($handlerData);
    }

}