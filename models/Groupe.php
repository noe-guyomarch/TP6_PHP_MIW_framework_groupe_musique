<?php

class GroupeModel extends Model
{
    public $id;
    public $name;
    public $country_origin;
    public $year_creation;

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
        $req = Model::getBdd()->prepare('SELECT * FROM band WHERE id=:id');
        $req->bindValue('id', $id);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $req->fetch();
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
        $req = $this->bdd->prepare('INSERT INTO band (id, name, country_origin, year_creation) 
            VALUE (:id, :name, :country_origin, :year_creation)');
        $req->bindValue('id', $this->id);
        $req->bindValue('name', $this->name);
        $req->bindValue('country_origin', $this->country_origin);
        $req->bindValue('year_creation', $this->year_creation);

        $req->execute();
        $this->id = $this->bdd->lastInsertId();
    }

    /**
     * Met à jour les informations du don dans la base de données.
     * @return bool
     */
    public function update()
    {       
        $req = $this->bdd->prepare('UPDATE band SET 
            name=:name, country_origin=:contry_origin, year_creation=:year_creation, WHERE id=:id');
        $req->bindValue('name', $this->name);
        $req->bindValue('country_origin', $this->country_origin);
        $req->bindValue('year_creation', $this->year_creation);
        $req->bindValue('id', $this->id);

        $req->execute();
    }

    public static function getAll()
    {
        $req = Model::getBdd()->prepare('SELECT * FROM band');
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $req->fetchAll();
    }

    public static function delete($id)
    {       
        $req = Model::getBdd()->prepare('DELETE FROM band WHERE id=:id');
        $req->bindValue('id', $id);

        return  $req->execute();
    }
}