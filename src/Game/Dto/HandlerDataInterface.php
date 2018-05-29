<?php

namespace Game\Dto;

use Game\Entities\MapInterface;
use Game\Enums\EnumInterface;
use Game\Events\EventInterface;

/**
 * Interface HandlerDataInterface
 * @package Game\Dto
 */
interface HandlerDataInterface
{
    /**
     * @return EnumInterface
     */
    public function getCommandStepping(): EnumInterface;

    /**
     * @return MapInterface
     */
    public function getMap(): MapInterface;

    /**
     * @return EventInterface
     */
    public function getEvent(): EventInterface;

    /**
     * @param EnumInterface $enum
     */
    public function setCommandStepping(EnumInterface $enum);

    /**
     * @param MapInterface $map
     */
    public function setMap(MapInterface $map);

    /**
     * @param EventInterface $event
     */
    public function setEvent(EventInterface $event);

    /**
     * @param DataResponseInterface $dataResponse
     */
    public function setDataResponse(DataResponseInterface $dataResponse);

    /**
     * @return DataResponseInterface
     */
    public function getDataResponse(): DataResponseInterface;
}