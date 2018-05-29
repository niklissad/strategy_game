<?php

namespace Game\Behavioral;

/**
 * Interface MessageObserver
 * @package Game\Behavioral
 */
interface MessageObserverInterface
{
    /**
     * @param mixed $message
     */
    public function message($message);
}