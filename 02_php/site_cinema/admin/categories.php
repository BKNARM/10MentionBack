<?php

require_once "../inc/functions.inc.php";

// gestion de l'accessibilité des admins
if (empty($_SESSION['user'])) {

    header('location:' . RACINE_SITE . 'authentification.php');
} else {
    if ($_SESSION['user']['role'] == 'ROLE_USER') {

        header('location:' . RACINE_SITE . 'index.php');
    }
}






$info = "";

$categories = lesCategories();

//insertion des categories et validation des champs
if (!empty($_POST)) { //si le formulaire est envoyé
    // On vérifie si un champ est vide 
    $verif = true;

    foreach ($_POST as $key => $value) { //une boucle pour vérifier si un champ est vide

        if (empty(trim($value))) {
            $verif = false;
        }
    }

    if ($verif == false) { // si la $verif passe en false donc j'ai un champ vide

        $info = alert("Veuillez renseigner tout les champs", "danger"); //j'affiche
    } else { // tous les champs sont remplis je passe à la vérification et validation des données

        // on récupère les valeurs de nos champs et on les stocks dans des variables
        $name = trim($_POST['name']);
        $description = trim($_POST['description']);

        //validation

        $regex_nom = '/[0-9]/';

        if (!isset($name) || strlen($name) < 2 || strlen($name) > 20 || preg_match($regex_nom, $name)) { // preg_match — Effectue une recherche de correspondance avec une expression rationnelle standard
            $info = alert("Le champs nom n'est pas valide", "danger");
        }

        if (!isset($description) || strlen($description) < 20) { // preg_match — Effectue une recherche de correspondance avec une expression rationnelle standard
            $info .= alert("Le champs nom n'est pas valide", "danger");
        } elseif (empty($info)) {

            //on vérifie si la catégorie existe dans la BDD

            $name = strtolower($name);
            $name = htmlentities($name);


            $categoriyBdd = showCategory($name);
            if ($categoriyBdd) {
                $info = alert("la catégorie existe déjà", "danger");
            } else { // si elle n'esxiste pas on va l'insérer dans la BDD


                $description = htmlentities($description);
                if (isset($_GET) && $_GET['action'] == 'update' && !empty($_GET['id_category'])) {

                    $idCategory = htmlentities($_GET['id_category']);
                    updateCategory($idCategory, $name, $description);
                    header('location:categories.php');
                } else {
                    addCategory($name, $description);
                }
            }
        }
    }
}


//suppression et modification d'une catégorie

if (isset($_GET) && isset($_GET['action']) && isset($_GET['id_category']) && !empty($_GET['action']) && !empty($_GET['id_category'])) {



    $idCategory = htmlentities($_GET['id_category']);


    if (is_numeric($id_category)) {

        $category = showCategoryViaID($idCategory);
        if ($category) {

            if ($_GET['action'] == 'delete') {

                deleteCategory($idCategory);

            }
            if ($_GET['action'] != 'update') {

                header('location:categories.php');


            }
            
        }else {

            header('location:categories.php');
        }

        
    } else {

        header('location:categories.php');
    }

    // header('location:categories.php');
}




require_once "../inc/header.inc.php";




?>

<div class="row mt-5" style="padding-top: 8rem;">
    <div class="col-sm-12 col-md-6 mt-5">
        <h2 class="text-center fw-bolder mb-5 text-danger">Gestion des catégories</h2>

        <?= $info; ?>

        <form action="" method="post" class="back">

            <div class="row">
                <div class="col-md-8 mb-5">
                    <label for="name">Nom de la catégorie</label>
                    <!-- <input type="text" id="name" name="name" class="form-control" value="<//?=isset($category) ? $category['name']: ''?>"> -->
                    <input type="text" id="name" name="name" class="form-control" value="<?= $category['name'] ?? '' ?>">

                </div>
                <div class="col-md-12 mb-5">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control" rows="10"><?= isset($category) ? $category['description'] : '' ?></textarea>
                </div>

            </div>
            <div class="row justify-content-center">
                <button type="submit" class="btn btn-danger p-3"><?= isset($category) ? 'Modifier une categorie' : 'ajouter une catégorie' ?></button>
            </div>
        </form>
    </div>

    <div class="col-sm-12 col-md-6 d-flex flex-column mt-5 pe-3 table-responsive">
        <!-- tableau pour afficher toute les catégories avec des boutons de suppression et de modification -->
        <h2 class="text-center fw-bolder mb-5 text-danger">Liste des catégories</h2>

        <?php
        $categories = allCategories();
        // debug($categories);
        ?>


        <table class="table table-dark table-bordered mt-5 table-responsive ">
            <thead>
                <tr>
                    <!-- th*7 -->
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

                        <td><?= $categorie['id_category'] ?></td>
                        <td><?= html_entity_decode($categorie['name']) ?></td> <!-- une majuscule sur la première lettre avec ucfirst()-->
                        <td><?= substr(html_entity_decode($categorie['description']), 0, 100) . '...' ?></td><!-- Convertit les entités HTML à leurs caractères correspondant
                        -->
                        <td class="text-center"><a href="?action=delete&id_category=<?= $categorie['id_category'] ?>"><i class="bi bi-trash3-fill"></i></a></td>
                        <td class="text-center"><a href="?action=update&id_category=<?= $categorie['id_category'] ?>"><i class="bi bi-pen-fill"></i></a></td>

                    </tr>


                <?php

                }

                ?>





            </tbody>

        </table>







    </div>

    <?php
    require_once "../inc/footer.inc.php";
    ?>