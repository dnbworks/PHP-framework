<?php

declare(strict_types=1);

namespace MagmaCore\Traits;

use MagmaCore\Base\Exception\BaseLogicException;
use MagmaCore\GlobalManager\GlobalManager;
use MagmaCore\Session\SessionManager;

trait SystemTrait
{

    /**
     * Initialize the system session at the entry point with in the 
     * application
     *
     * @param boolean $useSessionGlobal
     * @return void
     */
    public static function sessionInit(bool $useSessionGlobal = false)
    {
        $session = SessionManager::initialize();
      
        if (!$session) {
            throw new BaseLogicException('Please enable session within your session.yaml configuration file.');
        } else if ($useSessionGlobal === true) {
            GlobalManager::set('global_session', $session);
        } else {
            return $session;
        }
        return false;
    }

}