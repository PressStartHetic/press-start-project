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
                      mobile_phone,
                      pro_phone,
                      city,
                      postcode,
                      adress,
                      consoles,
                      website,
                      notes,
                      facebook,
                      youtube,
                      twitch,
                      twitter,
                      job
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
                      mobile_phone,
                      pro_phone,
                      city,
                      postcode,
                      adress,
                      consoles,
                      website,
                      notes,
                      facebook,
                      youtube,
                      twitch,
                      twitter,
                      job
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
                      mobile_phone,
                      pro_phone,
                      city,
                      postcode,
                      adress,
                      consoles,
                      website,
                      notes,
                      facebook,
                      youtube,
                      twitch,
                      twitter,
                      job
                    )
                    VALUES(
                      NULL,
                      :userId,
                      :firstname,
                      :lastname,
                      :pseudonyme,
                      :email,
                      :mobile_phone,
                      :pro_phone,
                      :city,
                      :postcode,
                      :adress,
                      :consoles,
                      :website,
                      :notes,
                      :facebook,
                      :youtube,
                      :twitch,
                      :twitter,
                      :job
                      )';
        $requete = self::$db->prepare($sql);
        $requete->bindValue(':userId', (isset($statement['userId']))? $statement['userId'] : 0 , PDO::PARAM_INT);
        $requete->bindValue(':firstname', (isset($statement['firstname']))? $statement['firstname'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':lastname', (isset($statement['lastname']))? $statement['lastname'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':pseudonyme', (isset($statement['pseudonyme']))? $statement['pseudonyme'] : $statement['username'] , PDO::PARAM_STR);
        $requete->bindValue(':email', (isset($statement['email']))? $statement['email'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':mobile_phone', (isset($statement['mobilePhone']))? $statement['mobilePhone'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':pro_phone', (isset($statement['proPhone']))? $statement['proPhone'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':city', (isset($statement['city']))? $statement['city'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':postcode', (isset($statement['postcode']))? $statement['postcode'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':adress', (isset($statement['adress']))? $statement['adress'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':consoles', (isset($statement['consoles']))? $statement['consoles'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':website', (isset($statement['website']))? $statement['website'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':notes', (isset($statement['notes']))? $statement['notes'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':facebook', (isset($statement['facebook']))? $statement['facebook'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':youtube', (isset($statement['youtube']))? $statement['youtube'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':twitch', (isset($statement['twitch']))? $statement['twitch'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':twitter', (isset($statement['twitter']))? $statement['twitter'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':job', (isset($statement['job']))? $statement['job'] : "" , PDO::PARAM_STR);
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
                      mobile_phone = :mobile_phone,
                      pro_phone = :pro_phone,
                      city = :city,
                      postcode = :postcode,
                      adress = :adress,
                      consoles = :consoles,
                      website = :website,
                      notes = :notes,
                      facebook = :facebook,
                      youtube = :youtube,
                      twitch = :twitch,
                      twitter = :twitter,
                      job = :job
                    WHERE id = :id';
        $requete = self::$db->prepare($sql);
        $requete->bindValue(':id', $id, PDO::PARAM_INT);
        $requete->bindValue(':firstname', (isset($statement['firstname']))? $statement['firstname'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':lastname', (isset($statement['lastname']))? $statement['lastname'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':pseudonyme', (isset($statement['pseudonyme']))? $statement['pseudonyme'] : $statement['username'] , PDO::PARAM_STR);
        $requete->bindValue(':email', (isset($statement['email']))? $statement['email'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':mobile_phone', (isset($statement['mobilePhone']))? $statement['mobilePhone'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':pro_phone', (isset($statement['proPhone']))? $statement['proPhone'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':city', (isset($statement['city']))? $statement['city'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':postcode', (isset($statement['postcode']))? $statement['postcode'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':adress', (isset($statement['adress']))? $statement['adress'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':consoles', (isset($statement['consoles']))? $statement['consoles'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':website', (isset($statement['website']))? $statement['website'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':notes', (isset($statement['notes']))? $statement['notes'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':facebook', (isset($statement['facebook']))? $statement['facebook'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':youtube', (isset($statement['youtube']))? $statement['youtube'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':twitch', (isset($statement['twitch']))? $statement['twitch'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':twitter', (isset($statement['twitter']))? $statement['twitter'] : "" , PDO::PARAM_STR);
        $requete->bindValue(':job', (isset($statement['job']))? $statement['job'] : "" , PDO::PARAM_STR);
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
