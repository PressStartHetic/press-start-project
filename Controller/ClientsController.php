<?php

namespace Controller;

use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Model\ClientsModel;
use Helper\Controller\BaseController as BaseController;


class ClientsController extends BaseController
{
    public function listAction()
    {
        $model = new ClientsModel();
        $data = $model->getClients();

        return self::$twig->render('clients/list.html.twig',[
            'list' => $data
        ]);

    }

    public function profileAction(Request $request)
    {
        if ($request->get('id')) {
            $id = $request->get('id');
            $model = new ClientsModel();
            $data = $model->getClients($id);

            return self::$twig->render('clients/profile.html.twig',[
                'client' => $data
            ]);
        } else {
            return new Response('Error');
        }

    }
}
