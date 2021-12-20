<?php

declare(strict_types=1);

namespace MagmaCore\Session;

use MagmaCore\Session\SessionFactory;
use MagmaCore\Yaml\YamlConfig;

class SessionManager
{

    /**
     * Create an instance of our session factory and pass in the default session storage
     * we will fetch the session name and array of options from the core yaml configuration
     * files
     *
     * @return void
     */
    public static function initialize() : Object
    {
        $factory = new SessionFactory();
        return $factory->create('magmacore', \MagmaCore\Session\Storage\NativeSessionStorage::class, YamlConfig::file('session'));
    }

}