<?php

namespace Controller;

use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;
use Helper\Controller\BaseController as BaseController;

class UsersController extends BaseController
{
    public function loginAction()
    {

      return self::$twig->render('auth/login.html.twig');
    }

    public function registerAction()
    {

      return self::$twig->render('auth/register.html.twig');
    }

    public function profileAction()
    {

      return self::$twig->render('auth/profile.html.twig');
    }

    public function resetPasswordAction()
    {

      return self::$twig->render('auth/reset.html.twig');
    }
}
