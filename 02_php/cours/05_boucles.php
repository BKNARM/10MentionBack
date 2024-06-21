<?php
$title = "Cours PHP - BOUCLES";
$titre = "Boucles en PHP";
$monparagraphe = "Les boucles (aussi appelées structures itératives) sont un moyen de répéter plusieurs fois un même morceau de code. Une boucle est donc une répétition, comme on a pu le voir en JS
";
include_once ("inc/header.inc.php")
?>



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