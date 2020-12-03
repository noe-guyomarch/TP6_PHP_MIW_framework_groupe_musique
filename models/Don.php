<?php

class DonModel extends Model
{
    public $id;
    public $id_streamer;
    public $pseudo;
    public $message;
    public $montant;
    public $date;

    //CRUD
    //Create
    //Read
    //Update
    //Delete   


    /**
     *
     * @param $id
     */
    public static function find($id)
    {
        $req = Model::getBdd()->prepare('SELECT * FROM don WHERE id=:id');
        $req->bindValue('id', $id);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $req->fetch();
    }

    public static function findAllForMe($id) // retourne tot les dons fait au streamer don l id est en parametre
    {
        $req = Model::getBdd()->prepare('SELECT * FROM don WHERE id_streamer=:id_streamer ORDER BY date ASC');
        $req->bindValue('id_streamer', $id);

        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, 'Don');
        //renvoie une instance de Don
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
        $req = $this->bdd->prepare('INSERT INTO don (id_streamer, pseudo, message, montant, date) 
            VALUE (:id_streamer, :pseudo, :message, :montant, :date)');
        $req->bindValue('id_streamer', $this->id_streamer);
        $req->bindValue('pseudo', $this->pseudo);
        $req->bindValue('message', $this->message);
        $req->bindValue('montant', $this->montant);
        $req->bindValue('date', $this->date);

        $req->execute();
        $this->id = $this->bdd->lastInsertId();
    }

    /**
     * Met à jour les informations du don dans la base de données.
     * @return bool
     */
    public function update()
    {       
        $req = $this->bdd->prepare('UPDATE don SET 
            id=:oldid, id_streamer=:id_streamer, pseudo=:pseudo, message=:message, montant=:montant, date=:date
            WHERE id=:id');
        $req->bindValue('oldid', $this->oldid);
        $req->bindValue('id_streamer', $this->id_streamer);
        $req->bindValue('pseudo', $this->pseudo);
        $req->bindValue('message', $this->message);
        $req->bindValue('montant', $this->montant);
        $req->bindValue('date', $this->date);
        $req->bindValue('id', $this->id);

        $req->execute();
    }
}