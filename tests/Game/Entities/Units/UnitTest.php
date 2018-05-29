<?php

namespace Game\Entities\Units;

use Game\Enums\CommandEnum;
use Game\Enums\RaceEnum;
use PHPUnit\Framework\TestCase;

abstract class UnitTest extends TestCase
{
    /** @var Unit */
    protected $unit;
    /** @var CommandEnum */
    protected $command;
    /** @var RaceEnum */
    protected $race;

    public function test()
    {
        $this->assertTrue(true);
    }

    public function testGetCommand()
    {
        $this->assertEquals($this->unit->getCommand(), $this->command);
    }

    public function testGetRace()
    {
        $this->assertEquals($this->unit->getRace(), $this->race);
    }

    public function testGetLife()
    {
        $this->assertInternalType('int', $this->unit->getLife());
        $this->assertTrue($this->unit->getLife() > 0);
    }

    public function testGetDamage()
    {
        $this->assertInternalType('int', $this->unit->getDamage());
        $this->assertTrue($this->unit->getDamage() > 0);

    }

    public function testAddLife()
    {
        $life = $this->unit->getLife();
        $addLife = 20;

        $this->unit->addLife($addLife);
        $this->assertEquals($this->unit->getLife(), $life + $addLife);

        $this->unit->addLife($this->unit->getLife() * -1);
        $this->assertEquals($this->unit->getLife(), 0);
    }

    public function testCanMove()
    {
        $this->assertTrue($this->unit->canMove());
    }

    /**
     * @expectedException \Exception
     */
    public function testAddLifeException()
    {
        $this->unit->addLife($this->unit->getLife() * -1);
        $this->unit->addLife(1);
    }


}
