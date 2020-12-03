<?php

class StreamerModel extends Model
{
    public $id;
    public $nom;
    public $url_twitch;
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
        $req = Model::getBdd()->prepare('SELECT * FROM streamer WHERE id=:id');
        $req->bindValue('id', $id);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $req->fetch();
    }


    /**
     * Crée ou met à jour le streamer selon qu'il existe ou non dans la base de données.
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
     * Crée le streamer dans la base de données.
     * @return bool
     */
    public function create()
    {
        $req = $this->bdd->prepare('insert into streamer (nom, url_twitch) value (:nom, :url_twitch)');
        $req->bindValue('nom', $this->nom);
        $req->bindValue('url_twitch', $this->url_twitch);
        $exe = $req->execute();
        $this->id = $this->bdd->lastInsertId();
        return $exe;
    }

    /**
     * Met à jour les informations du streamer dans la base de données.
     * @return bool
     */
    public function update()
    {
        $req = $this->bdd->prepare('update streamer set nom=:nom, url_twitch=:url_twitch where id=:id');
        $req->bindValue('nom', $this->nom);
        $req->bindValue('url_twitch', $this->url_twitch);
        $req->bindValue('id', $this->id);
        return $req->execute();
    }

    
    public static function getAll()
    {
        $req = Model::getBdd()->prepare('SELECT * FROM streamer');
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $req->fetchAll();
    }

}