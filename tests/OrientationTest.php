<?php

use MarsRover\Orientation;
use PHPUnit\Framework\TestCase;

class OrientationTest extends TestCase
{
    public function testValidation()
    {
        $this->assertTrue(Orientation::validation('n'));
        $this->assertTrue(Orientation::validation('N'));
        $this->assertFalse(Orientation::validation('a'));
    }

    public function testSpinLeft()
    {
        $this->assertEquals('W', Orientation::spinLeft('n'));
        $this->assertEquals('N', Orientation::spinLeft('E'));
    }

    public function testSpinRight()
    {
        $this->assertEquals('E', Orientation::spinRight('n'));
        $this->assertEquals('N', Orientation::spinRight('W'));
    }
}