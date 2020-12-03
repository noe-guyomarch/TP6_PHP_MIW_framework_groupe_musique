<?php

class GroupeController extends Controller
{
    public function liste()
    {
        //récupère des données en base
        $listeDesGroupes = GroupeModel::getAll();

        //passer mes données à ma vue
        $this->set(['groupes' =>$listeDesGroupes]);

        //afficher ma vue
        $this->render('liste');
    }


    public function detail()
    {
        // verifier si isset getid     
        if (isset($_GET['id'])){

            //récupère des données en base
            $members = MemberModel::findMembersOfGroupe($_GET['id']);
            $tours = TourModel::findToursOfGroupe($_GET['id']);

            $currentDate = new DateTime();

           
            foreach ($tours as $key => $tour) {
                $date = $tour->date;
                $date = new DateTime($date);

                if ($currentDate > $date) {
                    unset ($tours[$key]);
                }else{
                    $tour->date = $date->format('d-m-Y');
                }
            }

            //passer mes données à ma vue
            $this->set(['members' =>$members]);
            $this->set(['tours' =>$tours]);


            //afficher ma vue
            $this->render('detail');
        }else{
            echo '404 - id missing';
        }
    }

    public function ajouter()
    {
        // verifier si le formulaire est envoyé
        if (isset($_POST['name'])) {


            //envoi des données en base
            $groupe = new GroupeModel($_POST);

            $groupe->save();

            header('Location:' . WEB_ROOT);
        }else{
            echo '406 - erreur formulaire';
        }
    }

    public function supprimer()
    {
        // verifier si id du membre est là 
        if (isset($_GET['id'])){

            //récupère des données en base
            $isDelete = GroupeModel::delete($_GET['id']);

            if ($isDelete) {
                header('Location:' . WEB_ROOT);
            }else{
                echo '405 - erreur requette SQL';
            }
        }else{
            echo '404 - id missing';
        }
    }
}