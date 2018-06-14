<?php

namespace Controller;

use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Helper\Controller\BaseController as BaseController;
use Model\UsersModel;
use Model\TagsModel;
use Model\ClientsModel;

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
      $model    = new ClientsModel();
      $data     = $model->getClients();

      $TagModel = new TagsModel();
      $tags     = $TagModel->getTagsByClient();

      return self::$twig->render('default/home.html.twig',[
        'clients' => $data,
        'tags'    => $tags,
        'user'    => self::$auth
      ]);
    }
}
