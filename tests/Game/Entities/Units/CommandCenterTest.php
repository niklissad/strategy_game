<?php

namespace Game\Entities\Units;


use Game\Entities\Earth\Land;
use Game\Entities\Earth\LandInterface;
use Game\Enums\CommandEnum;
use Game\Enums\RaceEnum;

class CommandCenterTest extends UnitTest
{
    public function setUp()
    {
        $this->command = $this->createMock(CommandEnum::class);
        $this->race = $this->createMock(RaceEnum::class);
        $this->unit = new CommandCenter($this->command, $this->race);
    }

    public function testCanAttachEarth()
    {
        $earth = $this->createMock(LandInterface::class);
        $this->assertTrue($this->unit->canAttachEarth($earth));
    }

    public function testCanAttack()
    {
        $earth = $this->createMock(TankInterface::class);
        $this->assertTrue($this->unit->canAttack($earth));

        $earth = $this->createMock(TankInterface::class);
        $this->assertTrue($this->unit->canAttack($earth));
    }

    public function testAttack()
    {
        $unit = new Tank(new CommandEnum(CommandEnum::BLUE), $this->race);
        $life = $unit->getLife();

        $this->unit->attack($unit);

        $this->assertEquals($life - $unit->getLife(), $this->unit->getDamage());
    }

    public function testAttachEarth()
    {
        $earth = new Land();

        $this->unit->attachEarth($earth);
        $this->assertEquals($this->unit, $earth->getEarthUnit());
    }

    /**
     * @expectedException \Exception
     */
    public function testAttachEarthException()
    {
        $earth1 = new Land();
        $earth2 = new Land();

        $this->unit->attachEarth($earth1);
        $this->assertEquals($this->unit, $earth1->getEarthUnit());

        $this->unit->attachEarth($earth2);
    }

    public function testCanMove()
    {
        $this->assertFalse($this->unit->canMove());
    }

}
