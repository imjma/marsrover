<?php

namespace MarsRover\Exceptions;

/**
 * Class OutOfPlateau
 * @package MarsRover\Exceptions
 */
class OutOfPlateau extends \Exception
{
    /**
     * @var string
     */
    protected $message = 'Landing out of plateau...';

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

