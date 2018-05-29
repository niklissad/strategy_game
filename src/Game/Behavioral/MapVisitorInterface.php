<?php

namespace Game\Behavioral;


use Game\Entities\MapInterface;

/**
 * Interface MapVisitorInterface
 * @package Game\Behavioral
 */
interface MapVisitorInterface
{
    /**
     * @param MapInterface $map
     */
    public function visitMap(MapInterface $map);
}