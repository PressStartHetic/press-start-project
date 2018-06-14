<?php

namespace Model;
use Helper\Model;
use \PDO;

/**
 * Class RevuesModel
 * Va gérer toutes les modifications de la table revues de la bdd
 * @package Controller
 */
class TagsModel extends Model
{
    /**
     * @param null $id
     * @return array | bool
     * @throws \Exception
     * Suivant les cas, la méthode va :
     * - sélectionner toutes les entrées de la table
     * - sélectionner une entrée correspondant à l'id passée en paramètre
     */
    public function getTags($id = null){
        if($id === null){
            $sql = 'SELECT
                      id,
                      name
                    FROM tags';

            $requete = self::$db->query($sql);

            return $requete->fetchAll(PDO::FETCH_OBJ);
        } else{
            $sql = 'SELECT
                            id,
                            name
                          FROM
                            tags
                          WHERE
                            id = :id';

            $requete = self::$db->prepare($sql);

            $requete->bindValue(':id', $id, PDO::PARAM_INT);
            $requete->execute();

            return $requete->fetch(PDO::FETCH_OBJ);
        }
    }

    public function getTagsByClient($id = null){
        if($id === null){
            $sql = 'SELECT
                      client_id,
                      tags.id,
                      tags.name
                    FROM
                      clients_tags
                    INNER JOIN
                      tags
                      ON clients_tags.tag_id = tags.id
                    GROUP BY client_id, tag_id';

            $requete = self::$db->query($sql);

            return $requete->fetchAll(PDO::FETCH_OBJ);
        } else{
            $sql = 'SELECT
                      client_id,
                      tags.id,
                      tags.name
                    FROM
                      clients_tags
                    INNER JOIN
                      tags
                      ON clients_tags.tag_id = tags.id
                    WHERE
                      client_id = :id
                    GROUP BY client_id, tag_id';

            $requete = self::$db->prepare($sql);

            $requete->bindValue(':id', $id, PDO::PARAM_INT);
            $requete->execute();


            return $requete->fetchAll(PDO::FETCH_OBJ);
        }
    }

    public function addTag($statement) {
      $sql = 'INSERT INTO
                  tags(
                      id,
                      name
                  )
                  VALUES(
                    NULL,
                    :name
                    )';

      $requete = self::$db->prepare($sql);
      $requete->bindValue(':name', (isset($statement['name']))? $statement['name'] : "" , PDO::PARAM_STR);

      $requete->execute();

      if ($requete->errorCode() !== "00000") {
          throw new \Exception('Argh database');
      }
    }

    public function updateTag($statement, $id){
        if(is_array($statement)){
            $sql = 'UPDATE tags
                    SET
                      name = :name
                    WHERE id = :id';
            $requete = self::$db->prepare($sql);
            $requete->bindValue(':id', $id, PDO::PARAM_INT);
            $requete->bindValue(':name', $statement['name'], PDO::PARAM_STR);
            $requete->execute();

            if ($requete->errorCode() !== "00000") {
                throw new \Exception('Argh database');
            }
        }
    }

    public function deleteTag($id){
        if(is_int($id)){
            $sql = 'DELETE FROM tags
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
