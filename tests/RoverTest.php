<?php

use MarsRover\Plateau;
use MarsRover\Position;
use MarsRover\Rover;
use PHPUnit\Framework\TestCase;

class RoverTest extends TestCase
{
    public function testPrintPosition()
    {
        $rover = new Rover(Plateau::create(5, 5), Position::locate(1, 2, 'N'));
        $this->assertEquals('1 2 N', $rover->printPosition());
    }

    public function testExplore()
    {
        $rover = new Rover(Plateau::create(5, 5), Position::locate(1, 2, 'N'));
        $rover->explore('LMLMLMLMM');
        $this->assertEquals('1 3 N', $rover->printPosition());
    }
}