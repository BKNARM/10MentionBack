<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
    <title>Cours PHP - Introduction</title>
</head>
<body>
<nav class="navbar navbar-dark bg-dark navbar-expand-lg" >
    <div class="container-fluid">
      <a class="navbar-brand" href="01_index.php"><img src="assets/img/logo.png" alt="logo php"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="index.php">Introduction</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="02_bases.php">Les bases</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="03_variables_constantes.php">Les variables et les constantes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="04_conditions.php">Les conditions en PHP</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="05_boucles.php">Les boucles en PHP</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="06_inclusions.php">Les importations des fichier</a>
          </li>
        </ul>

      </div>
    </div>
  </nav>
<header class="p-5 m-4 bg-light rounded-3 border">
    <section class="container py-5">
        <h1 class="display-5 fw-bold">Introduction au PHP</h1>
        <p class="col-md-12 fs-4">PHP, ce sigle est un acronyme récursif <span> Préprocesseur Hypertexte PHP</span>(PHP Hypertext Preprocessor).In s'agit d'un langage de script côte serveur open source utilisé pour le développement web dynamique et peut-être intégré dans des codes HTML,notez bien qu'un navigateur ne comprend pas le PHP</p>
    </section>
</header>
<main class="container-fluid px-5">
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <h2>La boucle while</h2>
            <p>La boucle est , comme en JS ,une boucle qui permet d'éxécuter un code TANT QUE la condition d'entrée est toujoure remplie.</p>
            <?php
                $a = 0;
                while ($a < 5) {
                    echo "<p>Tour n° $a</p>";
                    $a++;
                }
                $b=1920;

                echo " <form>
                <select>
                ";
                echo "<br>
                ";
                while ($b <= 2023) {
                  echo " <option selected='2023'> $b </option> ";
                  $b++;
                };
                echo "</select> <form>";
                $bb=2023;

                echo " <form>
                <select>
                ";
                while ($bb >= 1920) {
                  echo " <option > $bb </option> ";
                  $bb--;
                };
                echo "</select> <form>";
              ?>
              <div class="col-sm-12 :col-md-6">
                <h2>La boucle do while</h2>
                <?php
                $i=0;
                do{
                  echo"<p>$i</p>";
                  $i++;
                }while ($i>100);
                ?>

              </div>
              <div class="col-sm-12 col-md-6">
                <h2>La boucle for</h2>
                <p>La boucle forcomme toutes les boucle , sert à répéter un morceau de code tant que la condition n'est pas respectée.Sa structure est cepenfdant differente :</p>
                <ol>
                  <li><span>Initialisation de la variable</span></li>
                  <li><span>Condition de sortie</span></li>
                  <li><span>Incrementation de la variable</span></li>
                </ol>
              </div>
              <?php
              for ($i=0; $i<15;$i++){
                echo "<p>Tour n° $i</p>";
              }


                echo " <form>
                <select>
                ";

                for ($date= 1920;$date<=2024;$date++) {

                      echo " <option>$date </option> ";


                };
                echo " <option selected='----'>---- </option> ";
                echo "</select>";
                echo "
                <select>
                ";
                echo " <option >-- </option> ";
                for ($month=1;$month<=12;$month++) {

                      echo " <option>$month </option> ";


                };
                echo "</select>";
                echo " <form>
                <select>
                ";
                echo " <option >-- </option> ";
                for ($day=1;$day<=30;$day++) {

                      echo " <option>$day </option> ";


                };
                echo "</select> </form>";
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
        <div class="col-sm-12 col-md-6 mt-5">
                <h2>La boucle foreach</h2>
                <p>La boucle foreach sert à parcourir un tableau (array() ou []). On verra cette boucle plus en détails dans la page dédiée aux array(). </p>

                <p class="alert alert-danger">Attention. Lorsque que vous faites une boucle, vérifiez votre condition de sortie ainsi que l'incrémentation de votre variable. Sans incrémentation, vous aurez une boucle infinie.</p>

                <p class="alert alert-secondary">A force d'utilier les boucles, il sera de plus en plus logique de choisir telle ou telle boucle pour tel ou tel usage. </p>
          </div>
    </div>
    </main>
    <footer>
    <div class="d-flex justify-content-evenly align-items-center bg-dark text-white p-3">
      <a class="nav-link" target="_blank" href="https://www.php.net/manual/fr/langref.php">Doc PHP</a>
      <a class="nav-link" href="01_index.php"><img src="assets/img/logo.png" alt="logo php"></a>
      <a class="nav-link" target="_blank" href="https://devdocs.io/php/">DevDocs</a>
    </div>
  </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>