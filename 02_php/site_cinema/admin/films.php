<?php

    require_once "../inc/functions.inc.php";
    
    
    
    
    
    

    // gestion de l'accessibilité des admins
    if (empty($_SESSION['user'])) {
        header('location:'. RACINE_SITE.'authentification.php');
    } else {
        if($_SESSION['user']['role'] == 'ROLE_USER'){

            header('location:'. RACINE_SITE.'authentification.php');
            
        }
        
    }
    
    require_once "../inc/header.inc.php";


    

    if(isset($_GET) && isset($_GET['action']) && isset($_GET['id_film'])){

        $idFilm= htmlentities($_GET['id_film']);
    
        if ($_GET['action'] == 'delete' && !empty($_GET['id_film'])) {
            
            
            deleteFilm($idFilm);
            
        }
        if ($_GET['action'] == 'update' && !empty($_GET['id_film'])) {
            
            
            $film = modifierFilm($idFilm);
            
            
    
            
            
        } 
    
        // header('location:categories.php');
    }

?>


<div class="col-sm-12 col-md-12 d-flex flex-column mt-5 pe-3">
        <!-- tableau pour afficher toute les catégories avec des boutons de suppression et de modification -->
        <h2 class="text-center fw-bolder mb-5 text-danger">Liste des catégories</h2>

        <?php
        
        $films = recupFilm();
        // debug($categories);
        ?>


        <table class="table table-dark table-bordered mt-5 ">
            <thead>
                <tr>
                    <!-- th*7 -->
                    <th>ID</th>
                    <th>titre</th>
                    <th>realisateur</th>
                    <th>Acteur(s)</th>
                    <th>age limite</th>
                    <th>durée</th>
                    <th>description</th>
                    <th>date de sortie</th>
                    <th>image</th>
                    <th>prix</th>
                    <th>quantité</th>
                    <th>supprimer</th>
                    <th>modifier</th>
                </tr>
            </thead>
            <tbody>
                <?php

                foreach ($films as $key => $film) {
                ?>

                    <tr>

                        <td><?=$film['id_film']?></td>
                        <td><?=html_entity_decode($film['title'])?></td> <!-- une majuscule sur la première lettre avec ucfirst()-->
                        <td><?=substr(html_entity_decode($film['director']),0,100).'...' ?></td><!-- Convertit les entités HTML à leurs caractères correspondant
                        -->
                        <td><?=substr(html_entity_decode($film['actors']),0,100).'...' ?></td>
                        <td><?=substr(html_entity_decode($film['ageLimit']),0,100).'...' ?></td>
                        <td><?=substr(html_entity_decode($film['duration']),0,100).'...' ?></td>
                        <td><?=substr(html_entity_decode($film['synopsis']),0,100).'...' ?></td>
                        <td><?=substr(html_entity_decode($film['date']),0,100).'...' ?></td>
                        <td><?=substr(html_entity_decode($film['image']),0,100).'...' ?></td>
                        <td><?=substr(html_entity_decode($film['price']),0,100).'...' ?></td>
                        <td><?=substr(html_entity_decode($film['stock']),0,100).'...' ?></td>
                        <td class="text-center"><a href="?action=update&id_film=<?=$film['id_film']?>"><i class="bi bi-trash3-fill"></i></a></td>
                        <td class="text-center"><a href="?action=update&id_film=<?=$film['id_film']?>"><i class="bi bi-pen-fill"></i></a></td>

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