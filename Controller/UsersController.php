<?php

namespace Controller;

use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Helper\Controller\BaseController as BaseController;
use \Delight\Auth\InvalidEmailException;
use \Delight\Auth\InvalidPasswordException;
use \Delight\Auth\UserAlreadyExistsException;
use \Delight\Auth\TooManyRequestsException;
use \Delight\Auth\DuplicateUsernameException;
use \Delight\Auth\Role;

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
        if (self::$auth->isLoggedIn()) {

          return new RedirectResponse('/');
        } else {
          if(count($_POST) > 0){
              try {
                  self::$auth->loginWithUsername($_POST['username'], $_POST['password']);

                  // user is logged in
                  return new RedirectResponse('/');
              }
              catch (InvalidPasswordException $e) {
                  // wrong password
              }
              catch (TooManyRequestsException $e) {
                  // too many requests
              }
          } else {
              return self::$twig->render('auth/login.html.twig');
          }
        }
    }

    /**
     * Register page & action
     *
     * @Route("/register", name="register")
     * @Method({"GET", "POST"})
     */
    public function registerAction(Request $request)
    {
        if (self::$auth->isLoggedIn()) {
          if(count($_POST) > 0){
              try {
                  $userid = self::$auth->registerWithUniqueUsername($_POST['email'], $_POST['password'], $_POST['username']);
                  self::$auth->loginWithUsername($_POST['username'], $_POST['password']);

                  return new RedirectResponse('/');
              }
              catch (InvalidEmailException $e) {
                  // invalid email address
              }
              catch (InvalidPasswordException $e) {
                  // invalid password
              }
              catch (UserAlreadyExistsException $e) {
                  // user already exists
              }
              catch (TooManyRequestsException $e) {
                  // too many requests
              }
              catch (DuplicateUsernameException $e) {
                  // duplicate username
              }
          } else {
              // afficher le formulaire (si y'a rien dans POST)
              return self::$twig->render('auth/register.html.twig');
          }
          return self::$twig->render('auth/register.html.twig');
      } else {

        return new RedirectResponse('/');
      }
    }

    /**
     * Profile page
     *
     * @Route("/profile", name="profile")
     * @Method({"GET"})
     */
    public function profileAction(Request $request)
    {
      if (self::$auth->isLoggedIn()) {
        return self::$twig->render('auth/profile.html.twig', array(
          'user' => self::$auth,
        ));
      } else {

        return new RedirectResponse('/login');
      }
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

    public function passwordGenerator() {
      $char = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
      $pass = array();
      $charLength = strlen($char) - 1;
      for ($i = 0; $i < 8; $i++) {
         $n = rand(0, $charLength);
         $pass[] = $char[$n];
      }

      $password = implode($pass);

      return $password;
    }
}
