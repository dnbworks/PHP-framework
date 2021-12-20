<?php

declare(strict_types=1);

namespace MagmaCore\GlobalManager;

interface GlobalManagerInterface
{

    /**
     * Set the global variable
     * 
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function set(string $key, $value) : void;

    /**
     * Get the value of the set global variable
     * 
     * @param string $key
     * @return mixed
     */
    public static function get(string $key);

}