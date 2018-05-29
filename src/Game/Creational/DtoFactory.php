<?php

namespace Game\Creational;

use Game\Dto\Block;
use Game\Dto\DataResponse;
use Game\Dto\HandlerData;
use Game\Dto\HandlerDataInterface;
use Game\Dto\Message;
use Game\Dto\InformationStatusUnits;
use Game\Dto\Unit;

/**
 * Class DtoFactory
 * @package Game\Creational
 */
class DtoFactory
{
    /**
     * @return Block
     */
    public function createBlock(): Block
    {
        return new Block();
    }

    /**
     * @return Message
     */
    public function createMessage(): Message
    {
        return new Message();
    }

    /**
     * @return Unit
     */
    public function createUnit(): Unit
    {
        return new Unit();
    }

    /**
     * @return HandlerDataInterface
     */
    public function createHandlerData(): HandlerDataInterface
    {
        $data = new HandlerData();
        $data->setDataResponse(new DataResponse());

        return $data;
    }
}