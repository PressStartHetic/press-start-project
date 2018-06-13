<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel;
use Controller;

$routes = new RouteCollection();

$routes->add('home', new Route('/', array(
    '_controller' => 'Controller\FrontController::homeAction',
)));

$routes->add('login', new Route('/login', array(
    '_controller' => 'Controller\UsersController::loginAction',
)));

$routes->add('add_user', new Route('/users/add', array(
    '_controller' => 'Controller\UsersController::addUserAction',
)));

$routes->add('profile', new Route('/profile', array(
    '_controller' => 'Controller\UsersController::profileAction',
)));

$routes->add('clients_list', new Route('/clients-list', array(
    '_controller' => 'Controller\ClientsController::listAction',
)));

$routes->add('client_profile', new Route('/clients-list/{id}', array(
    '_controller' => 'Controller\ClientsController::profileAction',
)));
$routes->add('update_password', new Route('/new-user-password', array(
    '_controller' => 'Controller\UsersController::updatePasswordAction',
)));

return $routes;
