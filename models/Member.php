<?php

class MemberModel extends Model
{
    public $id;
    public $name;
    public $position;
    public $id_band;

    //CRUD
    //Create
    //Read
    //Update
    //Delete   


    /**
     * renvoi les donné pour l'id du groupe
     * @param $id
     */
    public static function find($id)
    {
        $req = Model::getBdd()->prepare('SELECT * FROM member WHERE id=:id');
        $req->bindValue('id', $id);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $req->fetch();
    }

    public static function findMembersOfGroupe($idGroupe)
    {
        $req = Model::getBdd()->prepare('SELECT * FROM member WHERE id_band=:id_band');
        $req->bindValue('id_band', $idGroupe);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $req->fetchAll();
    }

    /**
     * Crée ou met à jour le don selon qu'il existe ou non dans la base de données.
     * @return bool
     */
    public function save()
    {
        if (null === $this->id) {
            return $this->create();
        } else {
            return $this->update();
        }
    }

    /**
     * Crée le don dans la base de données.
     * @return bool
     */
    public function create()
    {
        $req = $this->bdd->prepare('INSERT INTO member (id, name, position, id_band) 
            VALUE (:id, :name, :position, :id_band)');
        $req->bindValue('id', $this->id);
        $req->bindValue('name', $this->name);
        $req->bindValue('position', $this->position);
        $req->bindValue('id_band', $this->id_band);

        $req->execute();
        $this->id = $this->bdd->lastInsertId();
    }

    /**
     * Met à jour les informations du don dans la base de données.
     * @return bool
     */
    public function update()
    {       
        $req = $this->bdd->prepare('UPDATE member SET 
            name=:name, position=:position, id_band=:id_band, WHERE id=:id');
        $req->bindValue('name', $this->name);
        $req->bindValue('position', $this->position);
        $req->bindValue('id_band', $this->id_band);
        $req->bindValue('id', $this->id);

        $req->execute();
    }

    public static function delete($id)
    {       
        $req = Model::getBdd()->prepare('DELETE FROM member WHERE id=:id');
        $req->bindValue('id', $id);

        return  $req->execute();
    }
}