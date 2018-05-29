<?php

namespace Game\Dto;


use Game\Entities\MapInterface;
use Game\Enums\EnumInterface;
use Game\Events\EventInterface;

/**
 * Class HandlerData
 * @package Game\Dto
 */
class HandlerData implements HandlerDataInterface
{
    /** @var EventInterface */
    private $event;
    /** @var MapInterface */
    private $map;
    /** @var EnumInterface */
    private $commandStepping;
    /** @var DataResponseInterface */
    private $dataResponse;

    /**
     * @return EventInterface
     */
    public function getEvent(): EventInterface
    {
        return $this->event;
    }

    /**
     * @param EventInterface $event
     */
    public function setEvent(EventInterface $event)
    {
        $this->event = $event;
    }

    /**
     * @return MapInterface
     */
    public function getMap(): MapInterface
    {
        return $this->map;
    }

    /**
     * @param MapInterface $map
     */
    public function setMap(MapInterface $map)
    {
        $this->map = $map;
    }

    /**
     * @return EnumInterface
     */
    public function getCommandStepping(): EnumInterface
    {
        return $this->commandStepping;
    }

    /**
     * @param EnumInterface $commandStepping
     */
    public function setCommandStepping(EnumInterface $commandStepping)
    {
        $this->commandStepping = $commandStepping;
    }

    /**
     * @param DataResponseInterface $dataResponse
     */
    public function setDataResponse(DataResponseInterface $dataResponse)
    {
        $this->dataResponse = $dataResponse;
    }

    /**
     * @return DataResponseInterface
     */
    public function getDataResponse(): DataResponseInterface
    {
        return $this->dataResponse;
    }


}