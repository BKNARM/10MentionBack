<?php
require_once "../inc/functions.inc.php";

if (empty($_SESSION['user'])) {

    header('location:' . RACINE_SITE . 'authentification.php');
} else {
    if ($_SESSION['user']['role'] == 'ROLE_USER') {

        header('location:' . RACINE_SITE . 'index.php');
    }
}


// Modification d'un film 
// if (isset($_GET) && isset($_GET['action']) &&  isset($_GET['id_film'])) {

//     $idFilm = htmlentities($_GET['id_film']);

//     if ($_GET['action'] == 'update' &&  !empty($_GET['id_film'])) {

        
//             // on récupére le film de la BDD via son id 
            
//             $film = showFilm($idFilm);
//             debug($film);
//     }
// }

if (isset($_GET) && isset($_GET['action']) && isset($_GET['id_film']) && !empty($_GET['action']) && !empty($_GET['id_film'])) {



    $idCategory = htmlentities($_GET['id_film']);


    if (is_numeric($id_category)) {

        $film = showFilm($idCategory);
        if ($film) {

            
            if ($_GET['action'] != 'update') {

                header('location:films.php');


            }
            
        }else {

            header('location:films.php');
        }

        
    } else {

        header('location:films.php');
    }

    // header('location:categories.php');
}







$info = "";

//validation du formulaire


if (!empty($_POST)) {

    
    $verif = true;
    foreach ($_POST as $key => $value) {
        if (empty(trim($value))) {
            $verif = false;
        }
    }

    // la superglobale $_FILES a un indice "image" qui correspond au "name" de l'input type="file" du formulaire, ainsi qu'un indice "name" qui contient le nom du fichier en cours de téléchargement.
    // Vérifie si le champ 'image' du tableau $_FILES n'est pas vide, ce qui signifie qu'un fichier est en cours de téléchargement.
    if (!empty($_FILES['image']['name'])) {  // $_FILES['image']['name'] contient le nom original du fichier téléchargé.

        // Définit la variable $image avec le nom du fichier téléchargé.
        // Cela crée le chemin relatif vers l'image qui sera utilisé pour stocker l'image et peut être utilisé dans les balises <img>.
        $image =  $_FILES['image']['name'];

        // Utilise la fonction copy() pour copier le fichier temporaire téléchargé (stocké à l'adresse contenue dans $_FILES['image']['tmp_name'])
        // vers un emplacement permanent. Le fichier est déplacé dans le dossier "../assets/img/" avec le nom original du fichier.

        // copy() prend deux arguments : le chemin source (le fichier temporaire) et le chemin de destination.
        copy($_FILES['image']['tmp_name'], '../assets/img/' . $image); // $_FILES['image']['tmp_name'] contient le chemin temporaire où le fichier est stocké après le téléchargement.
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


        if ($_FILES['image']['error'] != 0  || $_FILES['image']['size'] == 0 || !isset($_FILES ['image']['type']) ) {

            $info .= alert("L'image n'est pas valide", "danger");
        }


        $titleFilm = ($_POST['title']);
        $director = trim($_POST['director']);
        $actors = trim($_POST['actors']);
        $genre = trim($_POST['categories']);
        $duration = trim($_POST['duration']);
        $synopsis = trim($_POST['synopsis']);
        $dateSortie = trim($_POST['date']);
        $price = trim($_POST['price']);
        $stock = trim($_POST['stock']);
        $ageLimit = trim($_POST['ageLimit']);

        $regex_chiffre = '/[0-9]/';
        $regex_acteurs = '/.*\/.*/';

        //Explications: 
            //    .* : correspond à n'importe quel nombre de caractères (y compris zéro caractère), sauf une nouvelle ligne.
            //     \/ : correspond au caractère /. Le caractère / doit être précédé d'un backslash \ car il est un caractère spécial en expression régulière. Le backslash est appelé caractère d'échappement et il permet de spécifier que le caractère qui suit doit être considéré comme un caractère ordinaire.
            //     .* : correspond à n'importe quel nombre de caractères (y compris zéro caractère), sauf une nouvelle ligne.

        if (!isset($titleFilm) || strlen($titleFilm) < 2) {
            $info .= alert ("le champ titre n'est pas valide", "danger");
        }

        if (!isset($director) || strlen($director) < 2 || preg_match($regex_chiffre, $director)) {
            $info .= alert ("le champ Réalisateur n'est pas valide", "danger");
        }


        if( strlen($actors) < 3 || preg_match($regex_chiffre, $actors) || !preg_match($regex_acteurs, $actors) ){ // valider que l'utilisateur a bien inséré le symbole '/' : chaîne de caractères qui contient au moins un caractère avant et après le symbole /.
            
            $info .= alert("Le champ acteurs n'est pas valide, il faut séparer les acteurs avec le symbole","danger");

        }

        if( !isset($genre) || showCategoryViaId($genre) == false){ 
            $info .= alert("la categorie n'est pas valide","danger");

        }


        if (!isset($duration)) {
            $info .= alert("La durée n'est pas valide", "danger");
        }

        if (!isset($dateSortie)) {
            $info .= alert("La date n'est pas valide", "danger");
        }

        if (!isset($price) || !is_numeric($price)) {
            $info .= alert("Le prix n'est pas valide", "danger");
        }

        if (!isset($synopsis) || !strlen($synopsis) > 50) {
            $info .= alert("il faut que le résumée dépasse 50 caractères", "danger");
        }elseif (empty($info)) {

            if(isset($_GET) && isset($_GET['action']) && isset($_GET['id_film']) && !empty($_GET['action']) && !empty($_GET['id_film']) && $_GET(['action']) == 'update' ){

                $idFilm = htmlentities($_GET['id_film']);

                modifierFilm( $category_id,  $titleFilm,  $director,  $actors,  $duration,  $synopsis,  $dateSortie,  $price,  $stock,  $ageLimit,  $image);
                header('location:films.php');

            
            
            
            
        }else {
            if (verifFilm($titleFilm, $dateSortie)) {//si le film existe dans la BDD
                
                // j'affiche un message d'erreur
                $info .= alert("Le film existe dejat", "danger");
                
            }else{// si le film n'existe pas 

                // je l'insère dans la BDD
                insertFilm($genre, $titleFilm, $director, $actors, $duration, $synopsis, $dateSortie, $price, $stock, $ageLimit, $image );

                header('location:films.php');
            }
        }
        
}
}
}


require_once "../inc/header.inc.php";
?>


<h2 class="text-center fw-bolder mb-5 text-danger"><?=isset($film) ? 'Modifier le film' : 'Ajouter un film'?></h2>

<?php
echo $info;
?>
<form action="" method="post" class="back" enctype="multipart/form-data">
    <!-- il faut isérer une image pour chaque film, pour le traitement des images et des fichiers en PHP on utilise la surperglobal $_FILES -->
    <div class="row">
        <div class="col-md-6 mb-5">
            <label for="title">Titre de film</label>
            <input type="text" name="title" id="title" class="form-control" value="<?=$film['title'] ?? ''?>">

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
            <input type="text" class="form-control" id="director" name="director" value="<?=$film['director'] ?? ''?>">
        </div>
        <div class="col-md-6">
            <label for="actors">Acteur(s)</label>
            <input type="text" class="form-control" id="actors" name="actors" value="<?=$film['actors'] ?? ''?>" placeholder="séparez les noms d'acteurs avec un /">
        </div>
    </div>
    <div class="row">
        <!-- raccouci bs5 select multiple -->
        <div class="mb-3">
            <label for="ageLimit" class="form-label" value="<?=$film['ageLimit'] ?? ''?>">Àge limite</label>
            <select multiple class="form-select form-select-lg" name="ageLimit" id="ageLimit">
                <option value="10" <?php if (isset($film['ageLimit']) && $film['ageLimit']==10) echo 'selected'?>>10</option>
                <option value="13" <?php if (isset($film['ageLimit']) && $film['ageLimit']==13) echo 'selected'?>>13</option>
                <option value="16" <?php if (isset($film['ageLimit']) && $film['ageLimit']==16) echo 'selected'?>>16</option>
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
            <input class="form-check-input" type="radio" name="categories" id="<?=html_entity_decode($categorie["name"])?>" value="<?=$categorie["id_category"]?>"  <?=isset($film['category_id']) && $film['category_id'] == $categorie['id_category'] ? 'checked' : '' ?>>
                <!-- dans le cas d'une modification on vérifie si la clé étrangère du film à modifier est égale à la clé primaire de la categorie dans l'input -->
                <label class="form-check-label" for="<?= html_entity_decode($categorie['name']) ?>"><?= ucfirst( html_entity_decode($categorie['name'])) ?></label>

            </div>
        <?php
        }
        ?>


    </div>
    <div class="row">
        <div class="col-md-6 mb-5">
            <label for="duration">Durée du film</label>
            <input type="time" class="form-control" id="duration" name="duration" value="<?=$film['duration'] ?? ''?>">
        </div>

        <div class="col-md-6 mb-5">

            <label for="date">Date de sortie</label>
            <input type="date" name="date" id="date" class="form-control" value="<?=$film['date'] ?? ''?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-5">
            <label for="price">Prix</label>
            <div class=" input-group">
                <input type="text" class="form-control" id="price" name="price" aria-label="Euros amount (with dot and two decimal places)" value="<?=$film['price'] ?? ''?>">
                <span class="input-group-text">€</span>
            </div>
        </div>

        <div class="col-md-6">
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock" class="form-control" min="0" value="<?=$film['stock'] ?? ''?>"> <!--pas de stock négativ donc je rajoute min="0"-->
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <label for="synopsis">Synopsis</label>
            <textarea type="text" class="form-control" id="synopsis" name="synopsis" rows="10"><?=$film['synopsis'] ?? ''?></textarea>
        </div>
    </div>

    <div class="row justify-content-center">
        <button type="submit" class="btn btn-danger p-3 w-25"><?=isset($film) ? 'Modifier le film' : 'Ajouter un film'?></button>
    </div>

</form>


<?php

require_once "../inc/footer.inc.php";
?>