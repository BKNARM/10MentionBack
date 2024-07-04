<?php

require_once "../inc/functions.inc.php";
require_once "../inc/header.inc.php";


$info="";

$categories = lesCategories();


if (!empty($_POST)) {

    // On vérifie si un champ est vide 
    $verif = true;

    foreach ($_POST as $key => $value) {

        if (empty(trim($value))) {
            $verif = false;
        }
    }

    if ($verif == false) {

        $info = alert("Veuillez renseigner tout les champs", "danger");
    } else {

        // on récupère les valeurs de nos champs et on les stocks dans des variables
        $name = trim($_POST['name']);
        $description = trim($_POST['description']);



        $regex_nom = '/[0-9]/';

        if (!isset($name) || strlen($name) < 2 || strlen($name) > 20 || preg_match($regex_nom, $name)) { // preg_match — Effectue une recherche de correspondance avec une expression rationnelle standard
            $info = alert("Le champs nom n'est pas valide", "danger");
        }

        if (!isset($description) || strlen($description) < 10 || strlen($description) > 300 || preg_match($regex_nom, $description)) { // preg_match — Effectue une recherche de correspondance avec une expression rationnelle standard
            $info = alert("Le champs nom n'est pas valide", "danger");
        }

        ajoutCategories($name,$description);
    }
}







?>
<div class="d-flex col-12 divFormContainer justify-content-around">
    <div class="bg-dark d-flex flex-column align-items-center col-4 ">
        <h2>Gestion de catégories</h2>
        <?php
        echo $info;
        ?>
        <form class=" d-flex flex-column background-color  col-6">
            <div class="form-group d-flex flex-column mb-4">

                <label class="mb-4 text-black fw-bold" for="name">Nom de la catégorie</label>
                <input type="text" class="form-control " id="name" aria-describedby="emailHelp" placeholder="Entrez la categorie" name="name">

            </div>
            <div>
                <h4 class="mb-4 text-black fw-bold">Description</h4>
                <textarea class="form-control " id="exampleFormControlTextarea1" rows="3" name ="description"></textarea>
            </div>

            <button type="button" class="btn btn-danger my-5">Ajouter une categorie</button>
        </form>

    </div>

    <div class="bg-dark d-flex flex-column align-items-center col-6 ">
        <h2>Liste de catégories</h2>
        <table class="table  table-dark table-bordered mt-5">
            <thead>
                <tr>
                    <!-- th*14 -->
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>

                    <th>Supprimer</th>
                    <th>Modifier</th>
                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($categories as $key => $categorie) {




                ?>


                    <tr>
                        <th><?= $categorie['id_category'] ?></th>
                        <th><?= $categorie['name'] ?></th>
                        <th><?= $categorie['description'] ?></th>

                        <td class=""><a href="?action=delete&id_user=<?= $categorie['id_category'] ?>"><i class="bi bi-trash3"></i></a></td>
                    </tr>

                <?php
                }
                ?>
            </tbody>
        </table>

    </div>


</div>





<?php

require_once "../inc/footer.inc.php";

?>