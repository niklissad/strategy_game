<?php

namespace Game\Behavioral;


/**
 * Interface GamerSubjectInterface
 * @package Game\Behavioral
 */
interface MessageSubjectInterface
{
    /**
     * @param MessageObserverInterface $observer
     * @return mixed
     */
    public function attach(MessageObserverInterface $observer);

    /**
     * @param MessageObserverInterface $observer
     */
    public function detach(MessageObserverInterface $observer);

    /**
     * @param $message
     */
    public function notify($message);
}