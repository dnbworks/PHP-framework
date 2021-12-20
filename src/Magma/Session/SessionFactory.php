<?php

declare(strict_types=1);

namespace MagmaCore\Session;

use MagmaCore\Session\Exception\SessionStorageInvalidArgumentException;
use MagmaCore\Session\Storage\SessionStorageInterface;
use MagmaCore\Session\SessionInterface;

class SessionFactory
{

    public function __construct()
    { }

    /**
     * Factory method which creates the specified cache along with the specified kind of session storage.
     * After creating the session, it will be registered at the session manager
     * @param string $sessionName
     * @param string $storageObjectName
     * @param array $options
     * @return SessionInterface
     */
    public function create(string $sessionName, string $storageString, array $options = []) : SessionInterface
    {
        $storageObject = new $storageString($options);
        // echo 'passed';
        // die();
        if (!$storageObject instanceof SessionStorageInterface) {
            throw new SessionStorageInvalidArgumentException($storageString . ' is not a valid session storage object.');
        }

        return new Session($sessionName, $storageObject);
    }

}