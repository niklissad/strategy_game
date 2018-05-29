<?php

namespace Web\Controllers;


class Controller implements ControllerInterface
{
    /**
     *
     */
    public function process()
    {
        require_once(__DIR__ . '/../views/view.php');
    }
}