<?php

namespace Controller;

use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Helper\Controller\BaseController as BaseController;
use Model\UsersModel;
use Model\TagsModel;
use Model\ClientsModel;
use Controller\ClientsController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class FrontController extends BaseController
{

  public function listAction(Request $request)
  {

  }
    /**
     * Homepage
     *
     * @Route("/", name="home")
     * @Method({"GET"})
     */
    public function homeAction(Request $request)
    {
      if (self::$auth->isLoggedIn()) {
        $data     = new ClientsModel();
        $data     = $data->getClients();

        $TagModel = new TagsModel();
        $tags     = $TagModel->getTagsByClient();

        $user = self::$auth;

        $userId = $user->getUserId();

        if (!self::$isAdmin) {

            return new RedirectResponse('/users/list/'.$userId);
        } else {
            return self::$twig->render('default/home.html.twig',[
                'clients' => $data,
                'tags'    => $tags,
                'user'    => $user,
                'isAdmin' => self::$isAdmin
            ]);
        }
      } else {
        return new RedirectResponse('/login');
      }
    }
}
