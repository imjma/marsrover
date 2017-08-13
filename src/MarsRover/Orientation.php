<?php

namespace MarsRover;

/**
 * Class Orientation
 * @package MarsRover
 */
class Orientation
{
    /**
     * @var array
     */
    private static $orientation = ['N', 'W', 'S', 'E'];

    /**
     * Return if orientation in the array
     *
     * @param $orientation
     * @return bool
     */
    public static function validation($orientation)
    {
        return in_array(strtoupper($orientation), self::$orientation);
    }

    /**
     * Spin left of orientation
     *
     * @param $orientation
     * @return mixed
     */
    public static function spinLeft($orientation)
    {
        return self::spin($orientation, 1);
    }

    /**
     * Spin right of orientation
     *
     * @param $orientation
     * @return mixed
     */
    public static function spinRight($orientation)
    {
        return self::spin($orientation, -1);
    }

    /**
     * Spin orientation
     *
     * @param $orientation
     * @param $shift
     * @return mixed
     */
    private static function spin($orientation, $shift)
    {
        $key = array_search($orientation, self::$orientation);

        if ($key + $shift >= sizeof(self::$orientation)) {
            return self::$orientation[0];
        }
        if ($key + $shift < 0) {
            return end(self::$orientation);
        }

        return self::$orientation[$key + $shift];
    }
}