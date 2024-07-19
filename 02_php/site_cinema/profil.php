<?php

require_once "inc/functions.inc.php";
require_once "inc/header.inc.php";

// debug($_SESSION['user']['firstName']);
if (empty($_SESSION['user'])) {
     
    header("location" .RACINE_SITE. "authentification.php");

}



?>


<div class="mx-auto p-2 row flex-column align-items-center">
    <h2 class="text-center mb-5">Bonjour <?=$_SESSION['user']['firstName']; ?></h2>
    <div class="cardFilm">
        <div class="image">
            <?php
                if (($_SESSION)['user']['civility'] == 'f') {
            ?>

                <img src="assets/img/avatar_f.png" alt="Image avatar femme">

            <?php
                }else{
            ?>
                <img src="assets/img/avatar_h.png" alt="Image avatar homme">
            <?php
                }
            ?>
            <div class="details">
                <div class="center ">



                    <table class="table">
                        <tr>
                            <th scope="row" class="fw-bold"><?= $_SESSION['user']['firstName']; ?></th>
                            <td></td>

                        </tr>
                        <tr>
                            <th scope="row" class="fw-bold"><?= $_SESSION['user']['lastName']; ?></th>
                            <td></td>

                        </tr>
                        <tr>
                            <th scope="row" class="fw-bold"><?= $_SESSION['user']['pseudo']; ?></th>
                            <td colspan="2"></td>

                        </tr>
                        <tr>
                            <th scope="row" class="fw-bold"><?= $_SESSION['user']['email']; ?></th>
                            <td colspan="2"></td>

                        </tr>
                        <tr>
                            <th scope="row" class="fw-bold"><?= $_SESSION['user']['phone']; ?></th>
                            <td colspan="2"></td>

                        </tr>
                        <tr>
                            <th scope="row" class="fw-bold"><?= $_SESSION['user']['address']; ?></th>
                            <td colspan="2"></td>

                        </tr>

                    </table>



                    <a href="" class="btn mt-5">Modifier vos informations</a>



                </div>

            </div>







        </div>







        <?php

        require_once "inc/footer.inc.php";

        ?>