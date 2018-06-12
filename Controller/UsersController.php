<?php

namespace Controller;

use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Helper\Controller\BaseController as BaseController;
use \Delight\Auth\InvalidEmailException;
use \Delight\Auth\InvalidPasswordException;
use \Delight\Auth\UserAlreadyExistsException;
use \Delight\Auth\TooManyRequestsException;
use \Delight\Auth\DuplicateUsernameException;

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
        if(count($_POST) > 0){
            try {
                self::$auth->loginWithUsername($_POST['username'], $_POST['password']);

                // user is logged in
            }
            catch (InvalidPasswordException $e) {
                // wrong password
                dump('caca');
                die();
            }
            catch (TooManyRequestsException $e) {
                // too many requests
            }
        } else {
            return self::$twig->render('auth/login.html.twig');
        }


    }

    /**
     * Register page & action
     *
     * @Route("/register", name="register")
     * @Method({"GET", "POST"})
     */
    public function registerAction()
    {
        if(count($_POST) > 0){
            try {
                $userid = self::$auth->registerWithUniqueUsername($_POST['email'], $_POST['password'], $_POST['username']);

                // we have signed up a new user with the ID `$userId`
                // TODO: faire le redirect avec le routeur: SAMY !
                header("location: /home");
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
