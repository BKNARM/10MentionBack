<?php

require_once "inc/functions.inc.php";


if (isset($_GET) && !empty($_GET) ) {
    if (isset($_GET['id_category']) && !empty($_GET['id_category'])) {
        $idCategory = htmlentities($_GET['id_category']);

    if (is_numeric($idCategory)) {
        
        $films = filmsByCategory($idCategory);

        if (!$films) {
            header('location:index.php');
        }
    }else {
        header('location:index.php');
    }

    }elseif (isset($_GET['action']) && $_GET['action'] == 'voirPlus') {
        $films = allFilm();
    }
    
    



}else {
    $films = filmByDate();
}










require_once "inc/header.inc.php";

?>


<div class="films">
    <h2 class="fw-bolder fs-1 mx-5 text-center">Nos films</h2>

    <div class="row">
        <?php

        foreach ($films as $film) {



        ?>
            <div class="col-sm-12 col-md-6 col-lg-4 col-xxl-3">
                <div class="card">
                    <img src="<?=RACINE_SITE?>assets/img/<?=$film['image']?>" alt="" style="">
                    <div class="card-body">
                        <h3><?= $film['title'] ?></h3>
                        <h4><?=substr(html_entity_decode($film['synopsis']), 0, 40) . '...' ?></h4>

                        <h4><?=substr(html_entity_decode($film['director']), 0, 40)?></h4>
                        <p><span class="fw-bolder">Résumé : </span><?=substr(html_entity_decode($film['synopsis']), 0, 100) . '...' ?></p>
                        <a href="showFilm.php?id_film=<?= $film['id_film'] ?>" class="btn">Voir Plus</a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>

    <div class="col-12 text-center">
        <a href="<?=RACINE_SITE?>?action=voirPlus" class="btn p-4 fs-3">Voir plus de films</a>
    </div>
</div>






<?php

require_once "inc/footer.inc.php";

?>