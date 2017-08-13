<?php

namespace MarsRover;

use MarsRover\Exceptions\InvalidPosition;

/**
 * Class Position
 */
class Position
{
    /**
     * @var int
     */
    private $x;

    /**
     * @var int
     */
    private $y;

    /**
     * @var string
     */
    private $orientation;

    /**
     * Position constructor.
     * @param $x
     * @param $y
     * @param $orientation
     */
    public function __construct($x, $y, $orientation)
    {
        $this->x = $x;
        $this->y = $y;
        $this->orientation = strtoupper($orientation);
    }

    /**
     * Locate position
     *
     * @param $x
     * @param $y
     * @param $orientation
     * @return Position
     * @throws InvalidPosition
     */
    public static function locate($x, $y, $orientation)
    {
        if (is_numeric($x) && is_numeric($y) && Orientation::validation($orientation)) {
            return new self($x, $y, strtoupper($orientation));
        } else {
            throw new InvalidPosition();
        }
    }

    /**
     * Return if position is inside of plateau
     *
     * @param Plateau $plateau
     * @return bool
     */
    public function deploySuccess(Plateau $plateau)
    {
        return $this->getX() >= 0
            && $this->getX() <= $plateau->getX()
            && $this->getY() >= 0
            && $this->getY() <= $plateau->getY();
    }

    /**
     * @return int
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @return string
     */
    public function getOrientation()
    {
        return $this->orientation;
    }

    /**
     * spin left of rover
     */
    public function spinLeft()
    {
        $this->orientation = Orientation::spinLeft($this->orientation);
    }

    /**
     * spin right of rover
     */
    public function spinRight()
    {
        $this->orientation = Orientation::spinRight($this->orientation);
    }

    /**
     * Move rover by orientation
     *
     * @param Plateau $plateau
     */
    public function move(Plateau $plateau)
    {
        switch (strtoupper($this->orientation)) {
            case 'N':
                $this->forward($this->y, 1, $plateau->getY());
                break;

            case 'S':
                $this->forward($this->y, -1, $plateau->getY());
                break;

            case 'W':
                $this->forward($this->x, -1, $plateau->getX());
                break;

            case 'E':
                $this->forward($this->x, 1, $plateau->getX());
                break;
        }
    }

    /**
     * Forward rover
     *
     * @param $point
     * @param $shift
     * @param $max
     */
    private function forward(&$point, $shift, $max)
    {
        $point += $shift;

        if ($point < 0) {
            $point = 0;
            // throw new OutOfPlateau('Move out of plateau');
        }

        if ($point > $max) {
            $point = $max;
            // throw new OutOfPlateau('Move out of plateau');
        }
    }
}