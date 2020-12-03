<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>liste</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div id="app">
        <h1 style="margin: 10px 5px;">liste des groupes</h1>

        <table class="table">
            <thead>
                <tr>          
                    <th>Nom</th> 
                    <th>Pays</th> 
                    <th>Anné de création</th> 
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                //boucle pour afficher la liste
                /** @var MemberModel[] $members */
                foreach ($groupes as $groupe) {
                ?>
                    <tr>
                        <td><a href="<?php echo WEB_ROOT ?>groupe/detail?id=<?php echo $groupe->id ?>"><?php echo $groupe->name ?></a></td>
                        <td><?php echo $groupe->country_origin ?></td>
                        <td><?php echo $groupe->year_creation ?></td>
                        <td><a href="<?php echo WEB_ROOT ?>groupe/supprimer?id=<?php echo $groupe->id ?>">Supprimer</a></td>
                    </tr>               
                <?php
                }
                ?>
            </tbody>
        </table>

        <div v-for="(groupe, index) in groupes" style="margin: 20px 0px;">
            <form action="<?php echo WEB_ROOT ?>groupe/ajouter" method="POST">
                <input type="text"    id="name"           name="name"             v-model="groupe.name">

                <input type="text"    id="country_origin" name="country_origin"   v-model="groupe.country_origin">

                <input type="text"    id="year_creation"  name="year_creation"    v-model="groupe.year_creation">

                <input class="btn-success" type="submit" value="Ajouter">
                |
                <button class="btn-danger" type="button" @click="delGroupe(index)">Annuler</button>
            </form>
        </div>

        <button class="btn-success" type="button" @click="addGroupe">
            Ajouter un Groupe
        </button>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script type="text/javascript">
        var app = new Vue({
            el: '#app',
            data: function() {
                return {
                    groupes: [
                    ]
                }
            },
            methods: {
                addGroupe() {
                    this.groupes.push({
                        name: "",
                        country_origin: "",
                        year_creation:""
                    });
                },
                delGroupe(index) {
                    this.groupes.splice(index, 1);
                }
            }
        });
    </script>
 

    
</body>
</html>