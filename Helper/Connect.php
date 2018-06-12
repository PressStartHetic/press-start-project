<?php

namespace Helper;
use \PDO;

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
     * @var on attribue null à $pdo afin de ne faire qu'une seule connexion par la suite
     */
    private static $pdo = null;

    /**
     * @return \PDO $pdo
     */
    public static function getPDO()
    {
        // si $pdo est null alors on instancie une connexion
        if(is_null(self::$pdo)) {
            try{
                self::$pdo = new PDO('mysql:dbname=' . self::DB_NAME . ';host=' . self::DB_HOST , self::DB_USER , self::DB_PASS);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->exec("SET NAMES UTF8");
            } catch(\Exception $exception)  {
                die('Erreur :' . $exception->getMessage());
            }
        }

        return self::$pdo;
    }
}
