<?php

namespace MarsRover\Exceptions;

/**
 * Class InvalidOrientation
 * @package MarsRover\Exceptions
 */
class InvalidOrientation extends \Exception
{
    /**
     * @var string
     */
    protected $message = 'Landing with invalid orientation';

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

