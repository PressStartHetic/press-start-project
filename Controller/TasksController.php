<?php

namespace Controller;

use Helper\Controller\BaseController as BaseController;

class TasksController extends BaseController
{

    public function listTasks()
    {
        return self::$twig->render('taches/list.html.twig');
    }
}
