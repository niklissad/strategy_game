<?php

namespace Game\Entities\Units;


use Game\Entities\Earth\EarthInterface;
use Game\Entities\Earth\HillInterface;
use Game\Entities\Earth\Land;
use Game\Entities\Earth\WaterInterface;
use Game\Enums\CommandEnum;
use Game\Enums\RaceEnum;

class TankTest extends UnitTest
{
    public function setUp()
    {
        $this->command = $this->createMock(CommandEnum::class);
        $this->race = $this->createMock(RaceEnum::class);
        $this->unit = new Tank($this->command, $this->race);
    }

    public function testCanAttachEarth()
    {
        $earth = $this->createMock(HillInterface::class);
        $this->assertFalse($this->unit->canAttachEarth($earth));

        $earth = $this->createMock(WaterInterface::class);
        $this->assertFalse($this->unit->canAttachEarth($earth));

        $earth = $this->createMock(EarthInterface::class);
        $this->assertTrue($this->unit->canAttachEarth($earth));
    }

    public function testCanAttack()
    {
        $earth = $this->createMock(SoldierInterface::class);
        $this->assertTrue($this->unit->canAttack($earth));

        $earth = $this->createMock(TankInterface::class);
        $this->assertTrue($this->unit->canAttack($earth));

        $this->assertFalse($this->unit->canAttack($this->unit));
    }

    public function testAttack()
    {
        $unit = new Soldier(new CommandEnum(CommandEnum::BLUE), $this->race);
        $life = $unit->getLife();

        $this->unit->attack($unit);

        $this->assertEquals($life - $unit->getLife(), $this->unit->getDamage());
    }

    public function testAttachEarth()
    {
        $earth1 = new Land();
        $earth2 = new Land();

        $this->unit->attachEarth($earth1);
        $this->assertEquals($this->unit, $earth1->getEarthUnit());

        $this->unit->attachEarth($earth2);
        $this->assertEquals($this->unit, $earth2->getEarthUnit());

        $this->assertFalse($earth1->hasEarthUnit());
    }

}
