<?php

use MarsRover\Exceptions\InvalidPlateau;
use MarsRover\Exceptions\OutOfPlateau;
use MarsRover\Plateau;
use MarsRover\Position;
use MarsRover\Rover;
use PHPUnit\Framework\TestCase;

class PlateauTest extends TestCase
{
    public function testCreate()
    {
        $this->assertInstanceOf(Plateau::class, Plateau::create(5, 5));

        $this->expectException(InvalidPlateau::class);
        Plateau::create('x', 0);
    }

    public function testDeploy()
    {
        $plateau = Plateau::create(5, 5);
        $position = Position::locate(1, 2, 'N');
        $this->assertInstanceOf(Rover::class, $plateau->deploy($position));

        $position = Position::locate(6, 2, 'N');
        $this->expectException(OutOfPlateau::class);
        $plateau->deploy($position);
    }

    public function testGet()
    {
        $x = 5;
        $y = 10;
        $plateau = Plateau::create($x, $y);
        $this->assertEquals($x, $plateau->getX());
        $this->assertEquals($y, $plateau->getY());
    }
}