<?php

class TourModel extends Model
{
    public $id;
    public $place;
    public $date;
    public $price;
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
        $req = Model::getBdd()->prepare('SELECT * FROM tour WHERE id=:id');
        $req->bindValue('id', $id);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $req->fetch();
    }
    public static function findToursOfGroupe($idGroupe)
    {
        $req = Model::getBdd()->prepare('SELECT * FROM tour WHERE id_band=:idband ORDER BY date ASC');
        $req->bindValue('idband', $idGroupe);
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
        $req = $this->bdd->prepare('INSERT INTO tour (id, place, date, price, id_band) 
            VALUE (:id, :place, :date, :price, :id_band)');
        $req->bindValue('id', $this->id);
        $req->bindValue('place', $this->place);
        $req->bindValue('date', $this->date);
        $req->bindValue('price', $this->price);
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
        $req = $this->bdd->prepare('UPDATE tour SET 
            place=:place, date=:date, price=:price, id_band=:id_band WHERE id=:id');
        $req->bindValue('place', $this->name);
        $req->bindValue('date', $this->position);
        $req->bindValue('price', $this->price);
        $req->bindValue('id_band', $this->id_band);

        $req->execute();
    }

    public static function delete($id)
    {       
        $req = Model::getBdd()->prepare('DELETE FROM tour WHERE id=:id');
        $req->bindValue('id', $id);

        return  $req->execute();
    }
}