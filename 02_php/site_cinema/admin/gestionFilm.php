<?php
require_once "../inc/functions.inc.php";

if (empty($_SESSION['user'])) {

    header('location:' . RACINE_SITE . 'authentification.php');
} else {
    if ($_SESSION['user']['role'] == 'ROLE_USER') {

        header('location:' . RACINE_SITE . 'index.php');
    }
}



$info = "";

//validation du formulaire


if (!empty($_POST)) {

    die();
    $verif = true;
    foreach ($_POST as $key => $value) {
        if (empty(trim($value))) {
            $verif = false;
        }
    }

    // la superglobale $_FILES a un indice "image" qui correspond au "name" de l'input type="file" du formulaire, ainsi qu'un indice "name" qui contient le nom du fichier en cours de téléchargement.
    if (!empty($_FILES['image']['name'])) { //si le nom du fichier en cours de téléchargement n'est pas vide, alors c'est qu'on est en train de télécharger une photo

        $image = 'img/' . $_FILES['image']['name'];  // $image contient le chemin relatif de la photo et sera enregistré en BDD. On utilise ce chemin pour les "src" des balises <img>.

        copy($_FILES['image']['tmp_name'], '../assets/' . $image);

        // on enregistre le fichier image qui se trouve à l'adresse contenue dans $_FILES['image']['tmp_name'] vers la destination qui est le dossier "img" à l'adresse "../asstes/nom_du_fichier.jpg".
    }

    if ($verif == false || empty($image)) {
        $info = alert("veuillez renseigner tous les champs", "danger");
    } else {

        // on vérifie l'image : 
        // $_FILES['image']['name'] Nom
        // $_FILES ['image']['type'] Type
        // $_FILES ['image']['size'] Taille
        // $_FILES ['image']['tmp_name'] Emplacement temporaire
        // $_FILES ['image']['error'] Erreur si oui/non l'image a été réceptionné


            // if ($_FILES['image']['terror'] !=  || $_FILES['image']['terror'] == 0 || !isset($_FILES) ) {
            //     # code...
            // }



    }
}

if ($verif == false) {
    $info = alert("veuillez renseigner tous les champs", "danger");
} else {
}

require_once "../inc/header.inc.php";
?>


<h2 class="text-center fw-bolder mb-5 text-danger">Ajouter un film</h2>

<?php
echo $info;
?>
<form action="" method="post" class="back" enctype="multipart/form-data">
    <!-- il faut isérer une image pour chaque film, pour le traitement des images et des fichiers en PHP on utilise la surperglobal $_FILES -->
    <div class="row">
        <div class="col-md-6 mb-5">
            <label for="title">Titre de film</label>
            <input type="text" name="title" id="title" class="form-control" value="">

        </div>
        <div class="col-md-6 mb-5">
            <label for="image">Photo</label>
            <br>
            <input type="file" name="image" id="image">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-5">
            <label for="director">Réalisateur</label>
            <input type="text" class="form-control" id="director" name="director" value="">
        </div>
        <div class="col-md-6">
            <label for="actors">Acteur(s)</label>
            <input type="text" class="form-control" id="actors" name="actors" value="" placeholder="séparez les noms d'acteurs avec un /">
        </div>
    </div>
    <div class="row">
        <!-- raccouci bs5 select multiple -->
        <div class="mb-3">
            <label for="ageLimit" class="form-label">Àge limite</label>
            <select multiple class="form-select form-select-lg" name="ageLimit" id="ageLimit">
                <option value="10">10</option>
                <option value="13">13</option>
                <option value="16">16</option>
            </select>
        </div>
    </div>
    <div class="row">
        <label for="categories">Genre du film</label>

        <!--  Ici c'est les catégories qui sont déjà stockés dans la BDD et qu'on vas les récupérer à partir de cette dernière -->
        <?php
        $categories = allCategories();

        foreach ($categories as $key => $categorie) {
            # code...
        ?>
            <div class="form-check col-sm-12 col-md-4">
                <input class="form-check-input" type="radio" name="categories" id="<?= html_entity_decode($categorie['name']) ?>" value="<?= $categorie['id_category'] ?>">
                <label class="form-check-label" for="<?= html_entity_decode($categorie['name']) ?>"><?= html_entity_decode($categorie['name']) ?></label>

            </div>
        <?php
        }
        ?>


    </div>
    <div class="row">
        <div class="col-md-6 mb-5">
            <label for="duration">Durée du film</label>
            <input type="time" class="form-control" id="duration" name="duration" value="">
        </div>

        <div class="col-md-6 mb-5">

            <label for="date">Date de sortie</label>
            <input type="date" name="date" id="date" class="form-control" value="">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-5">
            <label for="price">Prix</label>
            <div class=" input-group">
                <input type="text" class="form-control" id="price" name="price" aria-label="Euros amount (with dot and two decimal places)" value="">
                <span class="input-group-text">€</span>
            </div>
        </div>

        <div class="col-md-6">
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock" class="form-control" min="0" value=""> <!--pas de stock négativ donc je rajoute min="0"-->
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <label for="synopsis">Synopsis</label>
            <textarea type="text" class="form-control" id="synopsis" name="synopsis" rows="10"></textarea>
        </div>
    </div>

    <div class="row justify-content-center">
        <button type="submit" class="btn btn-danger p-3 w-25">Ajouter un film</button>
    </div>

</form>


<?php

require_once "../inc/footer.inc.php";
?>