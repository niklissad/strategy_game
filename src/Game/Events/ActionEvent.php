<?php

namespace Game\Events;


use Game\Dto\CoordinateInterface;
use Game\Entities\GamerInterface;

/**
 * Class ActionEvent
 * @package Game\Events
 */
abstract class ActionEvent
{
    /** @var CoordinateInterface */
    private $coordinateFrom;
    /** @var CoordinateInterface */
    private $coordinateTo;
    /** @var GamerInterface */
    private $gamer;

    /**
     * Attack constructor.
     * @param CoordinateInterface $coordinateFrom
     * @param CoordinateInterface $coordinateTo
     * @param GamerInterface $gamer
     */
    public function __construct(
        CoordinateInterface $coordinateFrom,
        CoordinateInterface $coordinateTo,
        GamerInterface $gamer)
    {
        $this->coordinateFrom = $coordinateFrom;
        $this->coordinateTo = $coordinateTo;
        $this->gamer = $gamer;
    }

    /**
     * @return CoordinateInterface
     */
    public function getCoordinateFrom(): CoordinateInterface
    {
        return $this->coordinateFrom;
    }

    /**
     * @return CoordinateInterface
     */
    public function getCoordinateTo(): CoordinateInterface
    {
        return $this->coordinateTo;
    }

    /**
     * @return GamerInterface
     */
    public function getGamer(): GamerInterface
    {
        return $this->gamer;
    }


}