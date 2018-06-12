<?php

namespace Helper;
use \PDO;
use \Delight\Db\PdoDsn;

/**
 * Class Connect
 * Va nous permettre de se connecter à la bdd
 * @package Helper
 */
class Connect
{
    /**
     * CONST des identifiants de connexion
     */
    const DB_USER = 'root';
    const DB_PASS = 'root';
    const DB_HOST = 'localhost';
    const DB_NAME = 'press_start';

    /**
     * @var on attribue null à $db afin de ne faire qu'une seule connexion par la suite
     */
    private static $db = null;

    /**
     * @return \Delight\Db\PdoDsn $db
     */
    public static function getPDO()
    {
        // si $pdo est null alors on instancie une connexion
        if(is_null(self::$db)) {
            try{
                self::$db = new PdoDsn('mysql:dbname=' . self::DB_NAME . ';host=' . self::DB_HOST , self::DB_USER , self::DB_PASS);
            } catch(\Exception $exception)  {
                die('Erreur :' . $exception->getMessage());
            }
        }

        return self::$db;
    }
}
