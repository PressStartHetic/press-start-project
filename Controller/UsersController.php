<?php

namespace Controller;

use Delight\Db\Throwable\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Helper\Controller\BaseController as BaseController;
use \Delight\Auth\InvalidEmailException;
use \Delight\Auth\InvalidPasswordException;
use \Delight\Auth\UserAlreadyExistsException;
use \Delight\Auth\TooManyRequestsException;
use \Delight\Auth\DuplicateUsernameException;
use \Delight\Auth\InvalidSelectorTokenPairException;
use \Delight\Auth\TokenExpiredException;
use \Delight\Auth\ResetDisabledException;
use \Delight\Auth\Role;

class UsersController extends BaseController
{
    /**
     * Login page & action
     *
     * Route("/login", name="login")
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
     * Route("/users/add", name="add_user")
     * @Method({"GET", "POST"})
     */
    public function addUserAction(Request $request)
    {
        if (self::$auth->isLoggedIn() && self::$auth->hasRole(Role::ADMIN)) {
          if(count($_POST) > 0){
              try {
                 $userId = self::$auth->admin()->createUser($_POST['email'], $_POST['password'], $_POST['username']);
                 self::$auth->admin()->addRoleForUserById($userId, Role::ADMIN);
                 $this->resetPasswordAction();

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
              $randomPassword = $this->passwordGenerator();

              return self::$twig->render('auth/add-user.html.twig', array(
                  'randomPassword' => $randomPassword,
              ));
          }
      }
        return new RedirectResponse('/');
    }

    /**
     * Profile page
     *
     * Route("/profile", name="profile")
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
     * Route("/reset-password", name="reset_password")
     * @Method({"GET", "POST"})
     */
    public function resetPasswordAction()
    {
        try {
            self::$auth->forgotPassword($_POST['email'], function ($selector, $token) {
                $mail = new MailController();
                $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
                $url = $actual_link . '/new-user-password?selector=' . \urlencode($selector) . '&token=' . \urlencode($token);

                $body = self::$twig->render('mail/change-password.html.twig', array(
                    'link' => $url,
                ));
                $mail->sendMail($body);
            });

            // request has been generated
        } catch(Exception $e) {
            dump('Erreur !');
            die;
        }
    }

    public static function updatePasswordAction() {

        if(count($_POST) > 0){
            try {
                self::$auth->resetPassword($_POST['selector'], $_POST['token'], $_POST['password']);

                return new RedirectResponse('/');
            }
            catch (InvalidSelectorTokenPairException $e) {
                // invalid token
            }
            catch (TokenExpiredException $e) {
                // token expired
            }
            catch (ResetDisabledException $e) {
                // password reset is disabled
            }
            catch (InvalidPasswordException $e) {
                // invalid password
            }
            catch (TooManyRequestsException $e) {
                // too many requests
            }
        } else {
            try {
                self::$auth->canResetPasswordOrThrow($_GET['selector'], $_GET['token']);
                $token = $_GET['token'];
                $selector = $_GET['selector'];

                return self::$twig->render('auth/reset.html.twig', array(
                    'token' => $token,
                    'selector' => $selector,
                ));
            }
            catch (InvalidSelectorTokenPairException $e) {
                // invalid token
            }
            catch (TokenExpiredException $e) {
                // token expired
            }
            catch (ResetDisabledException $e) {
                // password reset is disabled
            }
            catch (TooManyRequestsException $e) {
                // too many requests
            }
        }
    }

    public function passwordGenerator() {
      $char = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
      $pass = array();
      $charLength = strlen($char) - 1;
      for ($i = 0; $i < 10; $i++) {
         $n = rand(0, $charLength);
         $pass[] = $char[$n];
      }

      $password = implode($pass);

      return $password;
    }
}
