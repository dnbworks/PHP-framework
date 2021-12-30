<?php

declare(strict_types=1);

namespace Magma\App\Controller;

use Magma\Base\BaseController;
use Magma\App\Model\UserModel;

class HomeController extends BaseController
{

    public function __construct($routeParams)
    {
        parent::__construct($routeParams);
    }

    public function indexAction()
    {
        $repo = new UserModel();
        $data = $repo->getRepo()->findOneBy(['email' => 'kiwononline@gmail.com']);
        // echo '<pre>';
        // var_dump($data);
        // echo '</pre>';
        $this->render('client/home/index.html.twig', []);
    }


    protected function before()
    {}

    protected function after()
    {}


}