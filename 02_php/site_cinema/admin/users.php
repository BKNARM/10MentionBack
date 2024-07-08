<?php

require_once "../inc/functions.inc.php";


$users = allUsers();
// debug($users);

if(isset($_GET) && isset($_GET['action']) && isset($_GET['id_user'])){

    if ($_GET['action'] == 'delete' && !empty($_GET['id_user'])) {
        
        $idUser = htmlentities($_GET['id_user']);
        deleteUser($idUser);
        
    }
    if ($_GET['action'] == 'update' && !empty($_GET['id_user'])) {
        
        $idUser = htmlentities($_GET['id_user']);
        $user = showUser($idUser);

        if ($user['role'] == 'ROLE_ADMIN') {
            updateRole('ROLE_USER', $idUser);
        }else {
            updateRole('ROLE_ADMIN', $idUser);
        }
        
    }

    header('location:users.php');
}



// gestion de l'accessibilité des pages admin

if (empty($_SESSION['user'])) {
    header('location:'. RACINE_SITE.'authentification.php');
} else {
    if($_SESSION['user']['role'] == 'ROLE_USER'){

        header('location:'. RACINE_SITE.'index.php');

    }

}

require_once "../inc/header.inc.php";

?>

<div class="d-flex flex-column m-auto mt-5 table-responsive">
    <!-- tableau pour afficher toutles films avec des boutons de suppression et de modification -->
    <h2 class="text-center fw-bolder mb-5 text-danger">Liste des utilisateurs</h2>
    <table class="table  table-dark table-bordered mt-5">
        <thead>
            <tr>
                <!-- th*14 -->
                <th>ID</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>Pseudo</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Civility</th>
                <th>Adresse</th>
                <th>Zip</th>
                <th>City</th>
                <th>Country</th>
                <th>Rôle actuel</th>
                <th>Supprimer</th>
                <th>Modifier Le rôle</th>
            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($users as $key => $user) {




            ?>


                <tr>
                    <th><?= $user['id_user']?></th>
                    <th><?= $user['firstName']?></th>
                    <th><?= $user['lastName']?></th>
                    <th><?= $user['pseudo']?></th>
                    <th><?= $user['email']?></th>
                    <th><?= $user['phone']?></th>
                    <th><?= $user['civility']?></th>
                    <th><?= $user['address']?></th>
                    <th><?= $user['zip']?></th>
                    <th><?= $user['city']?></th>
                    <th><?= $user['country']?></th>
                    <th><?= $user['role']?></th>
                    <td class="text-center"><a href="?action=delete&id_user=<?= $user['id_user']?>"><i class="bi bi-trash3"></i></a></td>
                    <td class="text-center">
                        <a class="btn btn-danger" href="?action=update&id_user=<?= $user['id_user']?>">
                            <?=$user['role'] == 'ROLE_ADMIN' ? 'Rôle_user' : 'Rôle_admin' ?>
                        </a>
                    </td>
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