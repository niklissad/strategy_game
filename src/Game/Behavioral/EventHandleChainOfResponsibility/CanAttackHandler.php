<?php

namespace Game\Behavioral\EventHandleChainOfResponsibility;

use Game\Dto\HandlerDataInterface;

/**
 * Class CanAttackHandler
 * @package Game\Behavioral\EventHandleChainOfResponsibility
 */
class CanAttackHandler extends Handler
{
    /**
     * @param HandlerDataInterface $handlerData
     * @param \Closure $callback
     */
    public function handle(HandlerDataInterface $handlerData, \Closure $callback)
    {
        $unitAttacker = $this->getUnit($handlerData, $handlerData->getEvent()->getCoordinateFrom());
        $unitVictim = $this->getUnit($handlerData, $handlerData->getEvent()->getCoordinateTo());


        $distance = $this->getDistance($handlerData->getEvent()->getCoordinateFrom(), $handlerData->getEvent()->getCoordinateTo());
        if ($distance > 1) {
            $handlerData->getDataResponse()->setMessage('Даний юніт може атакувати лише сусідні поля');
            $handlerData->getDataResponse()->setIsStepping(false);

            $callback($handlerData);

            return;
        }


        if (!$unitAttacker->canAttack($unitVictim)) {
            $handlerData->getDataResponse()->setMessage('Даний юніт не може атакувати вибраного юніта');
            $handlerData->getDataResponse()->setIsStepping(false);

            $callback($handlerData);

            return;
        }

        $this->next->handle($handlerData, $callback);
    }

}