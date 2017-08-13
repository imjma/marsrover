<?php

namespace MarsRover;

use MarsRover\Exceptions\InvalidOrientation;
use MarsRover\Exceptions\OutOfPlateau;

/**
 * Class Rover
 */
class Rover
{
    /**
     * @var Plateau
     */
    private $plateau;

    /**
     * @var Position
     */
    private $position;

    /**
     * Rover constructor.
     * @param Plateau  $plateau
     * @param Position $position
     * @throws InvalidOrientation
     * @throws OutOfPlateau
     */
    public function __construct(Plateau $plateau, Position $position)
    {
        if (!$position->deploySuccess($plateau)) {
            throw new OutOfPlateau();
        }

        if (!Orientation::validation($position->getOrientation())) {
            throw new InvalidOrientation();
        }

        $this->plateau = $plateau;
        $this->position = $position;
    }

    /**
     * Print position to text
     *
     * @return string
     */
    public function printPosition()
    {
        return $this->position->getX() . ' ' . $this->position->getY() . ' ' . $this->position->getOrientation();
    }

    /**
     * Explore mars by input commands
     *
     * @param $input
     */
    public function explore($input)
    {
        $commands = str_split($input);

        foreach ($commands as $cmd) {
            $this->control($cmd);
        }
    }

    /**
     * Control rover with command
     *
     * @param $cmd
     */
    private function control($cmd)
    {
        //L R M
        switch (strtoupper($cmd)) {
            case 'L':
                $this->position->spinLeft();
                break;

            case 'R':
                $this->position->spinRight();
                break;

            case 'M':
                $this->position->move($this->plateau);
                break;
        }
    }
}