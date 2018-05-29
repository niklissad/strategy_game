<?php

namespace Game\Entities\Earth;

use Game\Entities\Units\EarthUnitInterface;
use Game\Entities\Units\FlyUnitInterface;
use PHPUnit\Framework\TestCase;

abstract class EarthTest extends TestCase
{
    /** @var Earth */
    protected $earth;

    public function tests()
    {
        $this->assertFalse($this->earth->hasEarthUnit());
        $this->assertFalse($this->earth->hasFlyUnit());


        $earthUnit = $this->getMockBuilder(EarthUnitInterface::class)->getMock();

        $this->earth->setEarthUnit($earthUnit);
        $this->assertTrue($this->earth->hasEarthUnit());
        $this->assertEquals($this->earth->getEarthUnit(), $earthUnit);
        $this->earth->removeEarthUnit();
        $this->assertFalse($this->earth->hasEarthUnit());


        $flyUnit = $this->getMockBuilder(FlyUnitInterface::class)->getMock();

        $this->earth->setFlyUnit($flyUnit);
        $this->assertTrue($this->earth->hasFlyUnit());
        $this->assertEquals($this->earth->getFlyUnit(), $flyUnit);
        $this->earth->removeFlyUnit();
        $this->assertFalse($this->earth->hasFlyUnit());
    }

    /**
     * @expectedException \Error
     */
    public function testGetEarthUnitError()
    {
        $this->earth->getEarthUnit();
    }

    /**
     * @expectedException \Error
     */
    public function testGetFlyUnitError()
    {
        $this->earth->getFlyUnit();
    }
}
