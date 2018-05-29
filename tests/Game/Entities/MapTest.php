<?php

namespace Game\Entities;

use Game\Entities\Earth\Land;
use PHPUnit\Framework\TestCase;

class MapTest extends TestCase
{
    public function tests()
    {
        $map = new Map();

        $earth1 = new Land();
        $earth2 = new Land();

        $map->setEarth(1, 1, $earth1);
        $map->setEarth(1, 2, $earth2);

        $this->assertEquals($map->getEarth(1, 1), $earth1);
        $this->assertEquals($map->getEarth(1, 2), $earth2);

        $this->assertCount(2, $map->getAllEarth()[1]);
    }
}
