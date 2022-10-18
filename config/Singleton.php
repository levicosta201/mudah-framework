<?php

/*
 * This file is part of the leviframework to projetc webjump.
 *
 * (c) na Costa <levi.costa1@gmail.com>
 *
 * For non-commercial use
 * 
 */

namespace
class Singleton 
{
    private static $instance = null;

    public static function getInstance()
{
    if (self::$instance == null) {
        self::$instance = new Singleton();
    }

    return self::$instance;
}
}