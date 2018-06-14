<?php

namespace Controller;

use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Model\ClientsModel;
use Controller\UsersController;
use Helper\Controller\BaseController as BaseController;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Model\UsersModel;
use Model\TagsModel;

class ClientsController extends BaseController
{
    public function listAction(Request $request)
    {
        $model    = new ClientsModel();
        $data     = $model->getClients();

        $TagModel = new TagsModel();
        $tags     = $TagModel->getTagsByClient();

        return self::$twig->render('clients/list.html.twig',[
            'list' => $data,
            'tags' => $tags,
            'isAdmin' => self::$isAdmin
        ]);

    }

    public function profileAction(Request $request)
    {
        if ($request->get('id')) {
            $id = $request->get('id');
            $model = new ClientsModel();
            $data = $model->getClients($id);
            $TagModel = new TagsModel();
            $tags     = $TagModel->getTagsByClient($id);

            return self::$twig->render('clients/profile.html.twig',[
                'client' => $data,
                'tags'   => $tags,
                'isAdmin' => self::$isAdmin
            ]);
        } else {
            return new Response('Error');
        }

    }

    public function editAction(Request $request)
    {
      if (self::$auth->isLoggedIn() && UsersController::checkAdmin()) {
        $model = new ClientsModel();
        if (count($_POST) > 0) {
          $client = $request->request->all();
          $id     = $request->get('id');

          $model->updateClient($client, $id);

          $refer  = $request->getrequestUri();
          $refer  = explode('/',$refer);

          $router = $request->get('_router');

          if (in_array('clients', $refer)) {
            $res    = $router->generate('client_profile', array('id' => $id));
          } else {
            $res    = $router->generate('users_profile', array('id' => $id));
          }

          return new RedirectResponse($res);
        } else {
          $id   = $request->get('id');
          $data = $model->getClients($id);

          return self::$twig->render('clients/edit.html.twig',[
            'client' => $data
          ]);
        }
      }
    }

    public function deleteAction(Request $request)
    {

      $router        = $request->get('_router');
      $res           = $router->generate('clients_list');
      $id            = $request->get('id');

      $clientsModel  = new ClientsModel();
      $client        = $clientsModel->getClients($id);

      $usersModel    = new UsersModel();
      $userId        = (int) $client->userId;
      $user          = $usersModel->getUsers($userId);

      if ( $user !== 0 ) {
        try {
          self::$auth->admin()->deleteUserById($userId);
          $mail          = new MailController();
          $body = self::$twig->render('mail/delete.html.twig', array(
            'user' => $user['user'],
          ));

          $mail->sendMail($body, 'Suppression de compte sur Press Start :)', $user['user']->email);
        }
        catch (\Delight\Auth\UnknownIdException $e) {
          // unknown ID
        }
      }

      $clientsModel->deleteClient((int)$id);

      return new RedirectResponse($res);
    }
}
