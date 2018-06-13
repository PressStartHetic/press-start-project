<?php

namespace Model;
use Helper\Model;
use \PDO;

/**
 * Class RevuesModel
 * Va gérer toutes les modifications de la table revues de la bdd
 * @package Controller
 */
class ClientsModel extends Model
{
    /**
     * @param null $id
     * @return array | bool
     * @throws \Exception
     * Suivant les cas, la méthode va :
     * - sélectionner toutes les entrées de la table revues
     * - sélectionner une entrée correspondant à l'id passée en paramètre
     */
    public function getClients($id = null){
        if($id === null){
            $sql = 'SELECT
                      id, 
                      userId, 
                      firstname, 
                      lastname,
                      pseudonyme, 
                      email,
                      facebook,
                      youtube,
                      twitter,
                      twitch
                    FROM clients';

            $requete = self::$db->query($sql);

            return $requete->fetchAll(PDO::FETCH_OBJ);
        } else{
            $sql = 'SELECT 
                      id, 
                      userId, 
                      firstname, 
                      lastname,
                      pseudonyme, 
                      email,
                      facebook,
                      youtube,
                      twitter,
                      twitch
                    FROM clients
                    WHERE id = :id';
            $requete = self::$db->prepare($sql);
            $requete->bindValue(':id', $id, PDO::PARAM_INT);
            $requete->execute();

            if ($requete->errorCode() !== "00000") {
                throw new \Exception('Argh database');
            }

            return $requete->fetch(PDO::FETCH_OBJ);
        }
    }

    /**
     * @param $statement
     * @return string
     * @throws \Exception
     */
    public function addClient($statement){
        $sql = 'INSERT INTO
                    clients(
                        id,
                        userId,
                        firstname,
                        lastname,
                        pseudonyme,
                        email,
                        facebook,
                        youtube,
                        twitch,
                        twitter
                    )
                    VALUES(
                      NULL, 
                      :userId, 
                      :firstname, 
                      :lastname, 
                      :pseudonyme, 
                      :email,
                      :facebook,
                      :youtube,
                      :twitch,
                      :twitter
                      )';

                /*        BEGIN;
                        INSERT INTO users (username, email, password)
                  VALUES('testee', 'test@testfr', 'lol');
                INSERT INTO clients (userId, firstname, pseudonyme)
                  VALUES(LAST_INSERT_ID(),'le nom', 'testeee');
                COMMIT;*/

        $requete = self::$db->prepare($sql);
        $requete->bindValue(':userId', $statement['userId'], PDO::PARAM_INT);
        $requete->bindValue(':firstname', $statement['firstname'], PDO::PARAM_STR);
        $requete->bindValue(':lastname', $statement['lastname'], PDO::PARAM_STR);
        $requete->bindValue(':pseudonyme', $statement['pseudonyme'], PDO::PARAM_STR);
        $requete->bindValue(':email', $statement['email'], PDO::PARAM_STR);
        $requete->bindValue(':facebook', $statement['facebook'], PDO::PARAM_STR);
        $requete->bindValue(':youtube', $statement['youtube'], PDO::PARAM_STR);
        $requete->bindValue(':twitch', $statement['twitch'], PDO::PARAM_STR);
        $requete->bindValue(':twitter', $statement['twitter'], PDO::PARAM_STR);

        $requete->execute();

        if ($requete->errorCode() !== "00000") {
            throw new \Exception('Argh database');
        }

        return (int) self::$db->lastInsertId();
    }

    /**
     * @param $statement $id
     * @throws \Exception
     */
    public function updateClient($statement, $id){
        $sql = 'UPDATE clients 
                    SET 
                      firstname = :firstname, 
                      lastname = :lastname, 
                      pseudonyme = :pseudonyme, 
                      email = :email, 
                      facebook = :facebook,
                      youtube = :youtube,
                      twitch = :twitch,
                      twitter = :twitter
                    WHERE id = :id';
        $requete = self::$db->prepare($sql);
        $requete->bindValue(':id', $id, PDO::PARAM_INT);
        $requete->bindValue(':firstname', $statement['firstname'], PDO::PARAM_STR);
        $requete->bindValue(':lastname', $statement['lastname'], PDO::PARAM_STR);
        $requete->bindValue(':pseudonyme', $statement['pseudonyme'], PDO::PARAM_STR);
        $requete->bindValue(':email', $statement['email'], PDO::PARAM_STR);
        $requete->bindValue(':facebook', $statement['facebook'], PDO::PARAM_STR);
        $requete->bindValue(':youtube', $statement['youtube'], PDO::PARAM_STR);
        $requete->bindValue(':twitch', $statement['twitch'], PDO::PARAM_STR);
        $requete->bindValue(':twitter', $statement['twitter'], PDO::PARAM_STR);
        $requete->execute();

        if ($requete->errorCode() !== "00000") {
            throw new \Exception('Argh database');
        }
    }

    /**
     * @param $id
     * @throws \Exception
     */
    public function deleteClient($id){
        if(is_int($id)){
            $sql = 'DELETE FROM clients 
                    WHERE id = :id';
            $requete = self::$db->prepare($sql);
            $requete->bindValue(':id', $id, PDO::PARAM_INT);
            $requete->execute();

            if ($requete->errorCode() !== "00000") {
                throw new \Exception('Arg database');
            }
        }
    }
}

