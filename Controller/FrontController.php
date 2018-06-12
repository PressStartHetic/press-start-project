<?php

namespace Controller;

use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Helper\Controller\BaseController as BaseController;

class FrontController extends BaseController
{
    /**
     * Homepage
     *
     * @Route("/", name="home")
     * @Method({"GET"})
     */
    public function homeAction(Request $request)
    {

      return self::$twig->render('default/home.html.twig');
    }
}
