<?php

namespace Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Model\ClientsModel;
use Helper\Controller\BaseController as BaseController;
use \Delight\Auth\InvalidEmailException;
use \Delight\Auth\InvalidPasswordException;
use \Delight\Auth\UserAlreadyExistsException;
use \Delight\Auth\TooManyRequestsException;
use \Delight\Auth\DuplicateUsernameException;
use \Delight\Auth\InvalidSelectorTokenPairException;
use \Delight\Auth\TokenExpiredException;
use \Delight\Auth\ResetDisabledException;
use \Delight\Auth\UnknownIdException;
use \Delight\Auth\NotLoggedInException;
use \Delight\Auth\Role;
use Controller\MailController;
use Model\UsersModel;

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
     * Route("/users/add", name="users_add")
     * @Method({"GET", "POST"})
     */
    public function addUserAction(Request $request)
    {
        if (self::$auth->isLoggedIn() && $this->checkAdmin()) {
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
     * Route("/profil", name="profil")
     * @Method({"GET"})
     */
    public function profilAction(Request $request)
    {
      if (self::$auth->isLoggedIn()) {
        return self::$twig->render('auth/profil.html.twig', array(
          'user' => self::$auth,
        ));
      } else {

        return new RedirectResponse('/login');
      }
    }

    /**
     * Admin Add Clients
     *
     * @Route("/clients/add", name="client_add")
     * @Method({"GET", "POST"})
     */
    public function addClientAction(Request $request)
    {
      if (self::$auth->isLoggedIn() && $this->checkAdmin()) {
        if (count($_POST) > 0) {
          try {
            $pass = $this->passwordGenerator();
            $userId = self::$auth->admin()->createUser($_POST['email'], $pass, $_POST['username']);
            $client = $request->request->all();
            $client['userId'] = $userId;

            $this->resetPasswordAction();
            $clientRepository = new ClientsModel();
            $clientRepository->addClient($client);


            return new RedirectResponse('/clients/list');
          }
          catch (\Delight\Auth\InvalidEmailException $e) {
            // invalid email address
          }
          catch (\Delight\Auth\InvalidPasswordException $e) {
            // invalid password
          }
          catch (\Delight\Auth\UserAlreadyExistsException $e) {
            // user already exists
          }
        } else {

          return self::$twig->render('clients/add.html.twig');
        }

        return self::$twig->render('clients/add.html.twig');
      } else {

        return new RedirectResponse('clients/add.html.twig');
      }
    }

    public function resetPasswordAction()
    {
        try {
            self::$auth->forgotPassword($_POST['email'], function ($selector, $token) {
                $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
                $url = $actual_link . '/password?selector=' . \urlencode($selector) . '&token=' . \urlencode($token);

                $body = self::$twig->render('mail/reset.html.twig', array(
                    'link' => $url,
                ));

                $mail = new MailController();
                $mail->sendMail($body, 'Nouveau compte créé sur Press Start :)', $_POST['email']);
            });

            // request has been generated
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
          // invalid email address
        }
        catch (\Delight\Auth\EmailNotVerifiedException $e) {
          // email not verified
        }
        catch (\Delight\Auth\ResetDisabledException $e) {
          // password reset is disabled
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
          // too many requests
        }
    }


    /**
     * Reset Password page & action
     *
     * Route("/reset-password", name="reset_password")
     * @Method({"GET", "POST"})
     */
    public static function updatePasswordAction()
    {
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

    public function checkAdmin()
    {
      return self::$auth->hasAnyRole(
        Role::ADMIN,
        Role::SUPER_ADMIN
      );
    }

    public function passwordGenerator()
    {
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

    public function usersListAction()
    {

        $model = new UsersModel();
        $data = $model->getUsers();

        return self::$twig->render('auth/users-list.html.twig',[
            'list' => $data,
            'isAdmin' => $this->checkAdmin(),
        ]);

    }

    public function detailAction(Request $request)
    {
        if ($request->get('id')) {
            $id = $request->get('id');
            $model = new UsersModel();
            $data = $model->getUsers($id);

            return self::$twig->render('auth/user-detail.html.twig',[
                'user' => $data['user'],
                'client' => $data['client'],
            ]);
        } else {
            return new Response('Error');
        }

    }

    public function deleteUserAction(Request $request){
        if ($request->get('id')) {
            $id = $request->get('id');

            try {
                self::$auth->admin()->deleteUserById($id);
            }
            catch (UnknownIdException $e) {
               dump($e);
            }

            return new RedirectResponse('/users/list');
        } else {
            return new Response('Error');
        }
    }

    public function updateUserAction(Request $request) {

        if ($request->get('id')) {
            $id = $request->get('id');
            $model = new UsersModel();
            $model->updateUser($_POST, $id);

            return new RedirectResponse('/users/list/'.$id);
        } else {
            return new Response('Error');
        }
    }

    public function changeUserPassword(Request $request) {
        $id = $request->get('id');
        try {
            self::$auth->changePassword($_POST['oldPassword'], $_POST['newPassword']);
            return new RedirectResponse('/users/list/'.$id);
            // password has been changed
        }
        catch (NotLoggedInException $e) {
            // not logged in
            return new RedirectResponse('/login');
        }
        catch (InvalidPasswordException $e) {
            // invalid password(s)
            dump('Mauvais password');
            return new RedirectResponse('/users/list/'.$id);
        }
        catch (TooManyRequestsException $e) {
            // too many requests
            dump('Trop de requêtes');
            return new RedirectResponse('/users/list/'.$id);
        }
    }

    public function logout(){
        self::$auth->logOut();
        return new RedirectResponse('/login');
    }
}
