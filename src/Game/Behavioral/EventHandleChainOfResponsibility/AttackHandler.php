<?php

namespace Game\Behavioral\EventHandleChainOfResponsibility;

use Game\Dto\HandlerDataInterface;

/**
 * Class AttackHandler
 * @package Game\Behavioral\EventHandleChainOfResponsibility
 */
class AttackHandler extends Handler
{
    /**
     * @param HandlerDataInterface $handlerData
     * @param \Closure $callback
     */
    public function handle(HandlerDataInterface $handlerData, \Closure $callback)
    {
        $unitAttacker = $this->getUnit($handlerData, $handlerData->getEvent()->getCoordinateFrom());
        $unitVictim = $this->getUnit($handlerData, $handlerData->getEvent()->getCoordinateTo());

        $unitAttacker->attack($unitVictim);

        $handlerData->getDataResponse()->setMessage('Ви атакували');
        $handlerData->getDataResponse()->setIsStepping(true);

        $callback($handlerData);
    }

}