<?php

namespace App\Common;

class Constants
{
    public static $ACTIVE = 'active';
    public static $IN_ACTIVE = 'in_active';

    public static $MIN_LENGTH_USERNAME = 6;
    public static $STATUS = [];

    public static function init()
    {
        self::$STATUS = [
            self::$ACTIVE,
            self::$IN_ACTIVE
        ];
    }
}

Constants::init();
