<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
     <title>exercice php</title>
</head>
<body>
    <header class="col-12">
        <nav class="navbar  text-bg-secondary col-12">
            <div class="container col-6">
                
                <a href=""><p>LOGO</p></a>
                </a>
            </div>
            <div class="container d-flex justify-content-end justify-content-between col-6">
                <a href="index.php">Accueil</a>
                <a href="connexion.php">Connectez-vous</a>
                <a href="inscription.php">Inscription</a>
            </div>
        </nav>
    </header>
        <main class="container">
            <div class="bg-warning p-4 mb-5">
                <?php
                    echo '<pre>';
                    var_dump($_POST);
                    echo '</pre>';


                    echo "<table><tbody><tr>
                    ";
                        for ($day=0;$day<=9;$day++) {

                          echo " <td>colonne numero </td> ";


                    };
                        echo "

                        </tr>";
                        echo "
                        <tr> ";
                        for ($day=0;$day<=9;$day++) {

                          echo "<td> $day</td>";


                    };
                    echo "
                    </tr>";
                    echo "</tbody></table>";


                ?>

            </div>
            <div class="card" style="width: 18rem;">
                <img src="assets/img/sarenaliska.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Feuille</h5>
                    <p class="card-text">Feuille colorée</p>
                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                </div>
            </div>

            <div class="container">
        <div class="row">
            <?php
            // Tableau contenant les titres des colonnes (pour foreach)
            $cards = ["Feuille 1", "Feuille 2", "Feuille 3", "Feuille 4", "Feuille 5"];

            // Générer les cartes
            foreach ($cards as $title) {
                
            }
            ?>
        </div>
    </div>


        </main>

        

    

    <footer class="container d-flex justify-content-center">
        <p>&copy; 2024 Mon Site Web. Tous droits réservés.</p>
        
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>