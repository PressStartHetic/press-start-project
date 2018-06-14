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


class TagsController extends BaseController
{
    public function listAction(Request $request)
    {
        $model = new TagsModel();
        $data  = $model->getTags();

        return self::$twig->render('tags/list.html.twig',[
            'tags' => $data
        ]);
    }

    public function addAction(Request $request)
    {
      if (count($_POST) > 0) {
        $tag   = $request->request->all();
        $model = new TagsModel();
        $model->addTag($tag);

        $router        = $request->get('_router');
        $res           = $router->generate('tag_list');

        return new RedirectResponse($res);
      } else {

        return self::$twig->render('tags/add.html.twig');
      }
    }

    public function editAction(Request $request)
    {
      $model = new TagsModel();
      $id    = $request->get('id');

      if (count($_POST) > 0) {
        $tag   = $request->request->all();
        $model->updateTag($tag, $id);

        $router        = $request->get('_router');
        $res           = $router->generate('tag_list');

        return new RedirectResponse($res);
      } else {

        $data = $model->getTags($id);

        return self::$twig->render('tags/edit.html.twig',[
          'tag' => $data
        ]);
      }
    }

    public function deleteAction(Request $request)
    {
      $model         = new TagsModel();
      $id            = $request->get('id');

      $model->deleteTag((int)$id);

      $router        = $request->get('_router');
      $res           = $router->generate('tag_list');

      return new RedirectResponse($res);
    }
}
