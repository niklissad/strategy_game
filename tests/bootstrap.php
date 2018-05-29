<?php


$t = new \PHPUnit\Framework\Constraint\ArrayHasKey(22);
$loader = require __DIR__ . '/../vendor/autoload.php';
$loader->addPsr4('Game\\', __DIR__ . '/Game');

