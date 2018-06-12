<?php

namespace Controller;

use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Helper\Controller\BaseController as BaseController;

class UsersController extends BaseController
{
    /**
     * Login page & action
     *
     * @Route("/login", name="login")
     * @Method({"GET", "POST"})
     */
    public function loginAction(Request $request)
    {

      return self::$twig->render('auth/login.html.twig');
    }

    /**
     * Register page & action
     *
     * @Route("/register", name="register")
     * @Method({"GET", "POST"})
     */
    public function registerAction(Request $request)
    {

      return self::$twig->render('auth/register.html.twig');
    }

    /**
     * Profile page
     *
     * @Route("/profile", name="profile")
     * @Method({"GET"})
     */
    public function profileAction(Request $request)
    {

      return self::$twig->render('auth/profile.html.twig');
    }

    /**
     * Reset Password page & action
     *
     * @Route("/reset-password", name="reset_password")
     * @Method({"GET", "POST"})
     */
    public function resetPasswordAction(Request $request)
    {

      return self::$twig->render('auth/reset.html.twig');
    }
}
