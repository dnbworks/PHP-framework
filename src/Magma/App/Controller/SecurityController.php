<?php

declare(strict_types=1);

namespace Magma\App\Controller;

use Magma\Base\BaseController;

class SecurityController extends BaseController
{

    public function __construct($routeParams)
    {
        parent::__construct($routeParams);
    }

    public function login()
    {
        echo 'Login Page';
    }

}