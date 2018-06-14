<?php

namespace Helper\Controller;
use Helper\Connect;
use Helper\Model;
use \Delight\Auth\Auth;
use \Delight\Auth\Role;

/**
 * Class Controller
 * Permet de loader nos templates Twig pour tous nos controllers
 * et de rendre disponible l'auth partout
 * (les classes contenues dans controller en héritant)
 * @package Helper
 */
class BaseController
{
    protected static $twig;
    protected static $db;
    protected static $auth;
    protected static $isAdmin;


    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem('View/');
        self::$twig = new \Twig_Environment(
            $loader, array(
            'cache' => false,
            'debug' => true,
        ));

        self::$twig->addExtension(new \Twig_Extension_Debug());
        self::$auth = new Auth(Connect::getPDO(),null ,null , false);
        self::$isAdmin = self::$auth->hasAnyRole(Role::ADMIN, Role::SUPER_ADMIN);
    }
}
