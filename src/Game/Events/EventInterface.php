<?php

namespace Game\Events;

use Game\Dto\CoordinateInterface;
use Game\Entities\GamerInterface;


/**
 * Interface Event
 * @package Game\Events
 */
interface EventInterface
{
    /**
     * @return CoordinateInterface
     */
    public function getCoordinateFrom(): CoordinateInterface;

    /**
     * @return CoordinateInterface
     */
    public function getCoordinateTo(): CoordinateInterface;

    /**
     * @return GamerInterface
     */
    public function getGamer(): GamerInterface;

}