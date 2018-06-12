<?php

namespace Helper;

/**
 * Class Model
 * Permet de connecter nos modèles à la bdd
 * (les classes contenues dans model en héritant)
 * @package Helper
 */
class Model
{
    protected static $db;

    public function __construct()
    {
        self::$db = Connect::getPDO();
    }

}