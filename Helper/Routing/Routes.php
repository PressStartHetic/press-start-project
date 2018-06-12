<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel;
use Controller;

$routes = new RouteCollection();

$routes->add('home', new Route('/', array(
    '_controller' => array(new Controller\FrontController(), 'homeAction'),
)));

$routes->add('login', new Route('/login', array(
    '_controller' => array(new Controller\UsersController(), 'loginAction'),
)));

$routes->add('register', new Route('/register', array(
    '_controller' => array(new Controller\UsersController(), 'registerAction'),
)));

$routes->add('profile', new Route('/profile', array(
    '_controller' => array(new Controller\UsersController(), 'profileAction'),
)));

$routes->add('reset_password', new Route('/reset-password', array(
    '_controller' => array(new Controller\UsersController(), 'resetPasswordAction'),
)));

return $routes;
