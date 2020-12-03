<?php

class TourController extends Controller
{

    // ajoute un membre, son nom sa position 
    public function ajouter()
    {
        // verifier si le formulaire est envoyé
        if (isset($_POST['date'])) {

            $_POST['id_band'] = $_GET['id'];

            //envoi des données en base
            $member = new TourModel($_POST);
            $member->save();

            header('Location:' . WEB_ROOT . 'groupe/detail?id=' . $_GET['id']);
        }else{
            echo '406 - erreur formulaire';
        }
    }

    // supprime un membre, son nom sa position 
    public function supprimer()
    {
        // verifier si id du membre est là 
        if (isset($_GET['id']) && isset($_GET['idTour'])){

            //récupère des données en base
            $isDelete = TourModel::delete($_GET['idTour']);

            if ($isDelete) {
                header('Location:' . WEB_ROOT . 'groupe/detail?id=' . $_GET['id']);
            }else{
                echo '405 - erreur requette SQL';
            }
        }else{
            echo '404 - id missing';
        }
    }
}