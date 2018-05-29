<?php

namespace Game\Behavioral\EventHandleChainOfResponsibility;

use Game\Dto\HandlerDataInterface;

/**
 * Class CanMoveHandler
 * @package Game\Behavioral\EventHandleChainOfResponsibility
 */
class CanMoveHandler extends Handler
{
    /**
     * @param HandlerDataInterface $handlerData
     * @param \Closure $callback
     */
    public function handle(HandlerDataInterface $handlerData, \Closure $callback)
    {
        $unit = $this->getUnit($handlerData, $handlerData->getEvent()->getCoordinateFrom());

        if (!$unit->canMove()) {
            $handlerData->getDataResponse()->setMessage('Даний юніт не може пересуватися');
            $handlerData->getDataResponse()->setIsStepping(false);

            $callback($handlerData);

            return;
        }


        $distance = $this->getDistance($handlerData->getEvent()->getCoordinateFrom(), $handlerData->getEvent()->getCoordinateTo());
        if ($distance > 1) {
            $handlerData->getDataResponse()->setMessage('Даний юніт може переміститися лише на сусідні поля');
            $handlerData->getDataResponse()->setIsStepping(false);

            $callback($handlerData);

            return;
        }


        $earthTo = $handlerData->getMap()->getEarth(
            $handlerData->getEvent()->getCoordinateTo()->getX(),
            $handlerData->getEvent()->getCoordinateTo()->getY()
        );

        if (!$unit->canAttachEarth($earthTo)) {
            $handlerData->getDataResponse()->setMessage('Даний юніт не може переміститися на вибране поле');
            $handlerData->getDataResponse()->setIsStepping(false);

            $callback($handlerData);

            return;
        }


        if ($handlerData->getEvent()->getCoordinateFrom()->isFly() && $earthTo->hasFlyUnit()
            || !$handlerData->getEvent()->getCoordinateFrom()->isFly() && $earthTo->hasEarthUnit()) {
            $handlerData->getDataResponse()->setMessage('Даний юніт не може переміститися на поле де вже є юніт');
            $handlerData->getDataResponse()->setIsStepping(false);

            $callback($handlerData);

            return;
        }


        $this->next->handle($handlerData, $callback);
    }
}