<?php

namespace Game\Behavioral\EventHandleChainOfResponsibility;

use Game\Dto\CoordinateInterface;
use Game\Dto\HandlerDataInterface;
use Game\Entities\Units\UnitInterface;


/**
 * Class Handler
 * @package Game\Behavioral\ChainOfResponsibility
 */
abstract class Handler implements HandlerInterface
{
    /** @var HandlerInterface */
    protected $next;

    /**
     * @param HandlerInterface $eventHandler
     */
    final public function next(HandlerInterface $eventHandler)
    {
        $this->next = $eventHandler;
    }

    /**
     * @param HandlerDataInterface $handlerData
     * @param CoordinateInterface $coordinate
     * @return UnitInterface
     */
    protected function getUnit(HandlerDataInterface $handlerData, CoordinateInterface $coordinate): UnitInterface
    {
        $earth = $handlerData->getMap()->getEarth(
            $coordinate->getX(),
            $coordinate->getY()
        );

        if ($coordinate->isFly()) {
            $unit = $earth->getFlyUnit();
        } else {
            $unit = $earth->getEarthUnit();
        }

        return $unit;
    }

    /**
     * @param CoordinateInterface $from
     * @param CoordinateInterface $to
     * @return int
     */
    protected function getDistance(CoordinateInterface $from, CoordinateInterface $to): int
    {
        $latitude1 = $from->getX();
        $longitude1 = $from->getY();
        $latitude2 = $to->getX();
        $longitude2 = $to->getY();

        $earth_radius = 7;

        $dLat = deg2rad($latitude2 - $latitude1);
        $dLon = deg2rad($longitude2 - $longitude1);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * asin(sqrt($a));
        $d = $earth_radius * $c;

        return floor($d * 10);
    }
}