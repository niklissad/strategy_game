<?php

namespace Game\Enums;

use PHPUnit\Framework\TestCase;

class EnumTest extends TestCase
{
    public function tests()
    {
        $enum = new CommandEnum(CommandEnum::BLUE);
        $this->assertEquals($enum->getValue(), CommandEnum::BLUE);
    }
}
