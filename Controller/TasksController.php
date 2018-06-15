<?php

namespace Controller;

use Helper\Controller\BaseController as BaseController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TasksController extends BaseController
{

    public function listTasks()
    {
      if (self::$auth->isLoggedIn() && self::$isAdmin) {

        return self::$twig->render('taches/list.html.twig', array(
            'isAdmin' => self::$isAdmin
        ));
      } else {
        return new RedirectResponse('/login');
      }
    }
}
