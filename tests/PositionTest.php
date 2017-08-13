<?php

use MarsRover\Exceptions\InvalidPosition;
use MarsRover\Plateau;
use MarsRover\Position;
use PHPUnit\Framework\TestCase;

class PositionTest extends TestCase
{
    public function testLocate()
    {
        $this->assertInstanceOf(Position::class, Position::locate(1, 2, 'N'));

        $this->expectException(InvalidPosition::class);
        Position::locate(1, 2, 'A');
    }

    public function testGet()
    {
        $x = 1;
        $y = 2;
        $o = 'N';
        $position = Position::locate($x, $y, $o);
        $this->assertEquals($x, $position->getX());
        $this->assertEquals($y, $position->getY());
        $this->assertEquals($o, $position->getOrientation());
    }

    public function testDeploySuccess()
    {
        $x = 4;
        $y = 6;
        $o = 'N';
        $position = Position::locate($x, $y, $o);

        $this->assertTrue($position->deploySuccess(Plateau::create(10, 10)));
        $this->assertFalse($position->deploySuccess(Plateau::create(10, 5)));
    }

    public function testSpin()
    {
        $x = 4;
        $y = 6;
        $o = 'N';
        $position = Position::locate($x, $y, $o);

        $position->spinLeft();
        $this->assertEquals('W', $position->getOrientation());

        $position->spinRight();
        $this->assertEquals('N', $position->getOrientation());
    }

    public function testMove()
    {
        $plateau = Plateau::create(5, 5);

        $x = 1;
        $y = 2;
        $o = 'N';
        $position = Position::locate($x, $y, $o);

        $position->move($plateau);
        $this->assertEquals($y+1, $position->getY());
        $this->assertEquals($x, $position->getX());

        $position = Position::locate($x, $y, 'E');
        $position->move($plateau);
        $this->assertEquals($x+1, $position->getX());
        $this->assertEquals($y, $position->getY());
    }
}