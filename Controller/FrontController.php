<?php

namespace Controller;

use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;
use Helper\Controller\BaseController as BaseController;

class FrontController extends BaseController
{
    public function homeAction()
    {

      return self::$twig->render('default/home.html.twig');
    }
}
