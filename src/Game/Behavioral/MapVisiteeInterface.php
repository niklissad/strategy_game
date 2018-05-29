<?php

namespace Game\Behavioral;

/**
 * Interface VisiteeInterface
 * @package Game\Behavioral
 */
interface MapVisiteeInterface
{
    public function accept(MapVisitorInterface $visitorIn);
}