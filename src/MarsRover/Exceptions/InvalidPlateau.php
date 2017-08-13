<?php

namespace MarsRover\Exceptions;

/**
 * Class InvalidPlateau
 * @package MarsRover\Exceptions
 */
class InvalidPlateau extends \Exception
{
    /**
     * @var string
     */
    protected $message = 'Coordinates of plateau is invalid';

    /**
     * OutOfPlateau constructor.
     * @param null           $message
     * @param int            $code
     * @param \Exception $previous
     */
    public function __construct($message = null, $code = 0, \Exception $previous = null)
    {
        $message = is_null($message) ? $this->message : $message;
        parent::__construct($message, $code, $previous);
    }
}

