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

$routes->add('client_edit', new Route('/clients/list/{id}/edit', array(
    '_controller' => 'Controller\ClientsController::editAction',
)));

$routes->add('update_password', new Route('/password', array(
    '_controller' => 'Controller\UsersController::updatePasswordAction',
)));

$routes->add('client_add', new Route('/clients/add', array(
    '_controller' => 'Controller\UsersController::addClientAction',
)));

$routes->add('client_delete', new Route('/clients/delete/{id}', array(
    '_controller' => 'Controller\ClientsController::deleteClientAction',
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

$routes->add('users_delete', new Route('/users/delete/{id}', array(
    '_controller' => 'Controller\UsersController::deleteUserAction',
)));

$routes->add('users_update', new Route('/users/update/{id}', array(
    '_controller' => 'Controller\UsersController::updateUserAction',
)));

$routes->add('users_change_password', new Route('/users/update/password/{id}', array(
    '_controller' => 'Controller\UsersController::changeUserPassword',
)));

return $routes;
