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

$routes->add('register', new Route('/register', array(
    '_controller' => 'Controller\UsersController::registerAction',
)));

$routes->add('profile', new Route('/profile', array(
    '_controller' => 'Controller\UsersController::profileAction',
)));

$routes->add('reset_password', new Route('/reset-password', array(
    '_controller' => 'Controller\UsersController::resetPasswordAction',
)));

$routes->add('clients_list', new Route('/clients-list', array(
    '_controller' => 'Controller\ClientsController::listAction',
)));

$routes->add('client_profile', new Route('/clients-list/{id}', array(
    '_controller' => 'Controller\ClientsController::profileAction',
)));

return $routes;
