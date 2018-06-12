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
}

