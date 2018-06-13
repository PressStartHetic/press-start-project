<?php

namespace Model;
use Helper\Model;
use \PDO;

/**
 * Class RevuesModel
 * Va gérer toutes les modifications de la table revues de la bdd
 * @package Controller
 */
class UsersModel extends Model
{
    /**
     * @param null $id
     * @return array | bool
     * @throws \Exception
     * Suivant les cas, la méthode va :
     * - sélectionner toutes les entrées de la table
     * - sélectionner une entrée correspondant à l'id passée en paramètre
     */
    public function getUsers($id = null){
        if($id === null){
            $sql = 'SELECT
                      id,
                      email,
                      username
                    FROM users';

            $requete = self::$db->query($sql);

            return $requete->fetchAll(PDO::FETCH_OBJ);
        } else{
            $userQuery = 'SELECT
                            id,
                            email,
                            username,
                            roles_mask as role
                          FROM
                            users
                          WHERE
                            id = :id';

            $userRequete = self::$db->prepare($userQuery);
            $userRequete->bindValue(':id', $id, PDO::PARAM_INT);
            $userRequete->execute();

            $profileQuery = 'SELECT
                        users.id AS userId,
                        users.email AS userMail,
                        users.username,
                        users.roles_mask as role,
                        clients.firstname,
                        clients.lastname,
                        clients.pseudonyme,
                        clients.email AS clientMail,
                        clients.facebook,
                        clients.youtube,
                        clients.twitch,
                        clients.twitter
                    FROM
                        users
                    LEFT JOIN clients ON users.id = clients.userId
                    WHERE
                        userId = :id';


            $profileRequete = self::$db->prepare($profileQuery);
            $profileRequete->bindValue(':id', $id, PDO::PARAM_INT);
            $profileRequete->execute();

            $result = [
                'user' => $userRequete->fetch(PDO::FETCH_OBJ),
                'client' => $profileRequete->fetch(PDO::FETCH_OBJ),
            ];

            return $result;
        }
    }

}
