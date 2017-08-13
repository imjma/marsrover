<?php

namespace MarsRover;

use MarsRover\Exceptions\InvalidPlateau;
use MarsRover\Exceptions\OutOfPlateau;

/**
 * Class Plateau
 */
class Plateau
{
    /**
     * @var Plateau
     */
    private static $instance;

    /**
     * @var int
     */
    private $x;

    /**
     * @var int
     */
    private $y;

    /**
     * Plateau constructor.
     * @param $x
     * @param $y
     */
    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * Create Plateau
     *
     * @param $x
     * @param $y
     * @return Plateau
     * @throws \Exception
     */
    public static function create($x, $y)
    {
        if (is_numeric($x) && is_numeric($y) && $x > 0 && $y > 0) {
            return new self($x, $y);
        } else {
            throw new InvalidPlateau();
        }
    }

    /**
     * Deploy rover
     *
     * @param Position $position
     * @return Rover
     * @throws OutOfPlateau
     */
    public function deploy(Position $position)
    {
        if (!$position->deploySuccess($this)) {
            throw new OutOfPlateau();
        }
        return new Rover($this, $position);
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

}