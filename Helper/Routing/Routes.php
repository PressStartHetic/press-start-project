<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel;

$routes = new RouteCollection();

$routes->add('home', new Route('/', array(
    '_controller' => 'Controller\FrontController::homeAction',
)));

$routes->add('login', new Route('/login', array(
    '_controller' => 'Controller\UsersController::loginAction',
)));

$routes->add('profile', new Route('/profile', array(
    '_controller' => 'Controller\UsersController::profileAction',
)));

$routes->add('clients_list', new Route('/clients/list', array(
    '_controller' => 'Controller\ClientsController::listAction',
)));

$routes->add('client_profile', new Route('/clients/list/{id}', array(
    '_controller' => 'Controller\ClientsController::profileAction',
)));
$routes->add('update_password', new Route('/password', array(
    '_controller' => 'Controller\UsersController::updatePasswordAction',
)));

$routes->add('client_add', new Route('/clients/add', array(
    '_controller' => 'Controller\UsersController::addClientAction',
)));

$routes->add('users_list', new Route('/users/list', array(
    '_controller' => 'Controller\UsersController::usersListAction',
)));

$routes->add('users_profile', new Route('/users/list/{id}', array(
    '_controller' => 'Controller\UsersController::detailAction',
)));

$routes->add('users_add', new Route('/users/add', array(
    '_controller' => 'Controller\UsersController::addUserAction',
)));

return $routes;
