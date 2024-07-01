<?php

require_once "inc/functions.inc.php";
require_once "inc/header.inc.php";

$info = "";
$info2 = "";

if (!empty($_POST)) {

     // On vérifie si un champ est vide 
     $verif = true;

     foreach ($_POST as $key => $value) {

          if (empty(trim($value))) {
               $verif = false;
          }
     }

        if ($verif == false) {

          $info = alert("Veuillez renseigner tout les champs", "danger");
     } else {

          // on récupère les valeurs de nos champs et on les stocks dans des variables
          $lastName = trim($_POST['lastName']);
          $firstName = trim($_POST['firstName']);
          $pseudo = trim($_POST['pseudo']);
          $email = trim($_POST['email']);
          $phone = trim($_POST['phone']);
          $mdp = ($_POST['mdp']);
          $confirmMdp = trim($_POST['confirmMdp']);
          $civility = trim($_POST['civility']);
          $birthday = trim($_POST['birthday']);
          $address = trim($_POST['address']);
          $zip = trim($_POST['zip']);
          $city = trim($_POST['city']);
          $country = trim($_POST['country']);


          $regex_nom = '/[0-9]/';

          if (!isset($lastName) || strlen($lastName) < 2 || strlen($lastName) > 15 || preg_match($regex_nom, $lastName)) { // preg_match — Effectue une recherche de correspondance avec une expression rationnelle standard
               $info = alert("Le champs nom n'est pas valide", "danger");
          }


          if (!isset($firstName) || strlen($firstName) < 2 || strlen($firstName) > 15 || preg_match($regex_nom, $firstName)) { // preg_match — Effectue une recherche de correspondance avec une expression rationnelle standard
               $info .= alert("Le champs prenom n'est pas valide", "danger");
          }

          if (!isset($pseudo) || strlen($pseudo) < 2 || strlen($pseudo) > 20) {
               $info .= alert("Le champ pseudo n'est pas valide", "danger");
          }

          if (!isset($email)  || strlen($email) > 50 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {

               $info .= alert("L'email n'est pas valide", "danger");

               // La fonction filter_var() applique un filtre spécifique à une variable. Lorsqu'elle est utilisée avec la constante FILTER_VALIDATE_EMAIL, elle vérifie si la chaîne passée en paramètre est une adresse e-mail valide. Si l'adresse est valide, la fonction retourne la chaîne elle-même ; sinon, elle retourne false.
               // La constante FILTER_VALIDATE_EMAIL est utilisée dans la fonction filter_var() en PHP pour valider une adresse e-mail. C'est une option de filtrage qui permet de vérifier si une chaîne de caractères est une adresse e-mail valide selon le format standard des e-mails.


          }

          if (!isset($phone) || !preg_match("/^[0-9]{10}$/", $phone)) { //Verifie si le téléphone contient 10 chiffres

               $info .= alert("Le numéro de téléphone n'est pas valide", "danger");
          }

          $regexMdp = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
          /*
                    ^ : Début de la chaîne.
               (?=.*[A-Z]) : Doit contenir au moins une lettre majuscule.
               (?=.*[a-z]) : Doit contenir au moins une lettre minuscule.
               (?=.*\d) : Doit contenir au moins un chiffre.
               (?=.*[@$!%*?&]) : Doit contenir au moins un caractère spécial parmi @$!%*?&.
               [A-Za-z\d@$!%*?&]{8,} : Doit être constitué uniquement de lettres majuscules, lettres minuscules, chiffres et caractères spéciaux spécifiés, et doit avoir une longueur minimale de 8 caractères.
               $ : Fin de la chaîne.
          */

          if (!isset($mdp) || !preg_match($regexMdp, $mdp)) {

               $info .= alert("Le mot de passe n'est pas valide", "danger");
          }

          if (!isset($confirmMdp) || $mdp !== $confirmMdp) {
               $info .= alert("Les mots de passe ne correspondent pas", "danger");
          }

          if (!isset($civility) || !in_array($civility, ["h", "f"])) {
               $info .= alert("La civilité n'est pas valide", "danger");
          }


          $year1 = ((int) date('Y')) - 13; //2011
          $month = (date('m'));
          $date = (date('d'));
          // date limite supérieure
          $dateLimitSup = $year1 . "-" . $month . "-" . $date;

          //date limite inférieure

          $year2 = ((int) date('Y')) - 90;
          $dateLimitInf = $year2 . "-" . $month . "-" . $date;

          if (!isset($birthday) || ($birthday >  $dateLimitSup && $birthday < $dateLimitInf)) {

               $info .= alert("La date de naissance n'est pas valide", "danger");
          }

          // if (!isset($birthday) || !preg_match("/^\d{4}-\d{2}-\d{2}$/", $birthday)) {
          //      $info .= alert("La date de naissance n'est pas valide", "danger");
          // }

          if (!isset($address) || strlen($address) < 5 || strlen($address) > 50) {

               $info .= alert("L'adresse n'est pas valide", "danger");
          }

          if (!isset($zip) || !preg_match("/^[0-9]{5}$/", $zip)) {
               $info .= alert("Le code postal n'est pas valide", "danger");
          }

          if (!isset($city) || strlen($city) < 2 || strlen($city) > 50 || preg_match($regex_nom, $city)) {
               $info .= alert("La ville n'est pas valide", "danger");
          }

          if (!isset($country) || strlen($country) < 2 || strlen($country) > 50 || preg_match($regex_nom, $country)) {
               $info .= alert("Le pays n'est pas valide", "danger");
          }elseif (empty($info)) {
               
               //Vérifier si l'adresse mail, existe dns la BDD

               $emailExist = checkEmailUser($email);//cette variable stock l'utilisateur qui posséde  l'email renseigné en argument dans la fonction checkEmailUser
               // si l'email n'existe pas dans la BDD la variable stocke false


               debug($emailExist);
               if ($emailExist) {

                    $info = alert("Vous avez déja un compte", "danger");
               }


               //Vérifier si le pseudo existe dans la BDD

               $pseudoExist = checkPseudoUser($pseudo);//cette variable stock l'utilisateur qui posséde  le pseudo renseigné en argument dans la fonction checkPseudoUser
               // si le pseudo n'existe pas dans la BDD la variable stocke false

               if($pseudoExist){

                    $info = alert("Pseudo est déjat utilisé !", "danger");
               }

               if ($emailExist && $pseudoExist) {

                    $info = alert("Vous avez déja un compte", "danger");

               }else if (empty ($info)) {
                    
                    $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);// Cette fonction PHP crée un hachage sécurisé d'un mot de passe en utilisant un algorithme de hachage fort : génère une chaîne de caractères unique à partir d'une entrée. C'est un mécanisme unidirectionnel dont l'utilité est d'empêcher le déchiffrement d'un hash. Lors de la connexion, il faudra comparer le hash stocké dans la base de données avec celui du mot de passe fourni par l'internaute.
                    // PASSWORD_DEFAULT : constante indique à password_hash() d'utiliser l'algorithme de hachage par défaut actuel c'est le plus recommandé car elle garantit que le code utilisera toujours le meilleur algorithme disponible sans avoir besoin de modifications.
                    // debug($mdpHash);

                    inscriptionUsers( $lastName,  $firstName,  $pseudo,  $email,  $phone,  $mdpHash,  $civility,  $birthday,  $address,  $zip,  $city,  $country);

                    $info = alert('vous êtes bin inscrit, vous pouvez <a href="authentification.php" class="text-danger fw-bold">vous connectez</a>', 'success');
               }
               
          }

          // preg_match vérifie si le phone correspond à l'expression régulière précisée. 
          /* La regex s'écrit entre #
               Le ^ définit le début de l'expression
               Le $ définit la fin de l'expression     
               [0-9] définit l'intervalle des chiffres autorisés
               si je met {10} c'est que je définit que l'on en veut 10 précisément
               */
     }
}





?>




<main style="background:url(assets/img/5818.png) no-repeat; background-size: cover; background-attachment: fixed;">

     <div class="w-75 m-auto p-5" style="background: rgba(20, 20, 20, 0.9);">
          <h2 class="text-center mb-5 p-3">Créer un compte</h2>
          <?php
          debug($_POST); // ctrl + survole+ click sur une fonction nous ramene directement dans le fichier ou la variable est créé

          echo $info;

          ?>

          <form action="" method="post" class="p-5">
               <div class="row mb-3">
                    <div class="col-md-6 mb-5">
                         <label for="lastName" class="form-label mb-3">Nom</label>
                         <input type="text" class="form-control fs-5" id="lastName" name="lastName">
                    </div>
                    <div class="col-md-6 mb-5">
                         <label for="firstName" class="form-label mb-3">Prenom</label>
                         <input type="text" class="form-control fs-5" id="firstName" name="firstName">
                    </div>
               </div>
               <div class="row mb-3">
                    <div class="col-md-4 mb-5">
                         <label for="pseudo" class="form-label mb-3">Pseudo</label>
                         <input type="text" class="form-control fs-5" id="pseudo" name="pseudo">
                    </div>
                    <div class="col-md-4 mb-5">
                         <label for="email" class="form-label mb-3">Email</label>
                         <input type="text" class="form-control fs-5" id="email" name="email" placeholder="exemple.email@exemple.com">
                    </div>
                    <div class="col-md-4 mb-5">
                         <label for="phone" class="form-label mb-3">Téléphone</label>
                         <input type="text" class="form-control fs-5" id="phone" name="phone">
                    </div>

               </div>
               <div class="row mb-3">
                    <div class="col-md-6 mb-5">
                         <label for="mdp" class="form-label mb-3">Mot de passe</label>
                         <input type="password" class="form-control fs-5" id="mdp" name="mdp" placeholder="Entrer votre mot de passe">
                    </div>
                    <div class="col-md-6 mb-5">
                         <label for="confirmMdp" class="form-label mb-3">Confirmation mot de passe</label>
                         <input type="password" class="form-control fs-5 mb-3" id="confirmMdp" name="confirmMdp" placeholder="Confirmer votre mot de passe ">
                         <input type="checkbox" onclick="myFunction()"> <span class="text-danger">Afficher/masquer le mot de passe</span>
                    </div>


               </div>
               <div class="row mb-3">
                    <div class="col-md-6 mb-5">
                         <label class="form-label mb-3">Civilité</label>
                         <select class="form-select fs-5" name="civility">
                              <option value="h">Homme</option>
                              <option value="f">Femme</option>
                         </select>
                    </div>
                    <div class="col-md-6 mb-5">
                         <label for="birthday" class="form-label mb-3">Date de naissance</label>
                         <input type="date" class="form-control fs-5" id="birthday" name="birthday">
                    </div>
               </div>
               <div class="row mb-3">
                    <div class="col-12 mb-5">
                         <label for="address" class="form-label mb-3">Adresse</label>
                         <input type="text" class="form-control fs-5" id="address" name="address">
                    </div>
               </div>
               <div class="row mb-3">
                    <div class="col-md-3">
                         <label for="zip" class="form-label mb-3">Code postale</label>
                         <input type="text" class="form-control fs-5" id="zip" name="zip">
                    </div>
                    <div class="col-md-5">
                         <label for="city" class="form-label mb-3">Cité</label>
                         <input type="text" class="form-control fs-5" id="city" name="city">
                    </div>
                    <div class="col-md-4">
                         <label for="country" class="form-label mb-3">Pays</label>
                         <input type="text" class="form-control fs-5" id="country" name="country">
                    </div>
               </div>
               <div class="row mt-5">
                    <button class="w-25 m-auto btn btn-danger btn-lg fs-5" type="submit">S'inscrire</button>
                    <p class="mt-5 text-center">Vous avez dèjà un compte ! <a href="authentification.php" class=" text-danger">connectez-vous ici</a></p>
               </div>
          </form>
     </div>



</main>

<?php

require_once "inc/footer.inc.php";



?>