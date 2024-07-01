<!-- fichier qui contient les fonctions php à utiliser dans notre site -->

<?php

session_start()
function debug($var){
    echo '<pre class="border border-dark bg-light text-primary w-50 p-5 mt-5">';
    var_dump($var);
    echo "</pre>";
}

#############################Fonction d'alert#############################

function alert(string $contenu, string $class){

    return "<div class=\"alert alert-$class alert-dismissible fade show text-center w-50 m-auto mb-5\" role=\"alert\">
               $contenu
                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
            </div>";


}


#############################Fonction pour la connexion à la BDD#############################

// On vas utiliser l'extension PHP Data Objects (PDO), elle définit une excellente interface pour accéder à une base de données depuis PHP et d'exécuter des requêtes SQL .
// Pour se connecter à la BDD avec PDO il faut créer une instance de cet Objet (PDO) qui représente une connexion à la base,  pour cela il faut se servir du constructeur de la classe
// Ce constructeur demande certains paramètres:
// On déclare des constantes d'environnement qui vont contenir les information à la connexion à la BDD


//constante du serveur => localhost
define("DBHOST", "localhost");

//constante de l'utilisateur de la BDD du serveur en local => root
define("DBUSER", "root");

//constante pour le mot de passe du serveur en local => pas de mot de passe
define("DBPASS", "");

// constante pour le nom de la BDD
define("DBNAME", "cinema");


function connexionBDD()
{
    // $dsn = mysql:host=localhost;dbname=cinema;charset=utf8;

    $dsn = "mysql: host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8;";

    //Grâce à PDO(classe naative PHP) on peut lever une exception (une erreur) si la connexion à la BDD ne se réalise pas(exp: suite à une faute au niveau du nom de la BDD) et par la suite si elle cette erreur est capté on lui demande d'afficher une erreur

    try { // dans le try on vas instancier PDO, c'est créer un objet de la classe PDO (un élment de PDO)
        // avec la variable dsn et les constatntes d'environnement
        $pdo = new PDO($dsn, DBUSER, DBPASS); //dsn = data source mail
        echo "je suis connecté";

        //On définit le mode d'erreur de PDO sur Exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) { // PDOException est une classe qui représente une erreur émise par PDO et $e c'est l'objetde la clase en question qui vas stocker cette erreur
        die("Erreur : " . $e->getMessage()); // die d'arrêter le PHP et d'afficher une erreur en utilisant la méthode getmessage de l'objet $e
    }

    //le catch sera exécuter dès lors on aura un problème da le try


    return $pdo; //ici on utilise un return car on récupère l'objet de la fonction que l'on vas appelé  dans plusieurs autre fonctions

}



#############################Fonction pour la connexion à la BDD#############################

function creatTableCategories()
{

    $cnx = connexionBDD();
    $sql = "CREATE TABLE IF NOT EXISTS categories (
            id_category INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(50) NOT NULL,
            description TEXT NULL
        )";

    $request = $cnx->exec($sql);
}

creatTableCategories();

//creation de la table films
function createTableFilms()
{

    $cnx = connexionBdd();

    $sql = " CREATE TABLE IF NOT EXISTS films (
             id_film INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
             category_id INT NOT NULL,
             title VARCHAR(100) NOT NULL,
             director VARCHAR(100) NOT NULL,
             actors VARCHAR(100) NOT NULL,
             ageLimit VARCHAR(5) NULL,
             duration TIME NOT NULL,
             synopsis TEXT NOT NULL,
             date DATE NOT NULL,
             image VARCHAR(250) NOT NULL,
             price Float NOT NULL,
             stock BIGINT NOT NULL
             )";
    $request = $cnx->exec($sql);
}
createTableFilms();

//creation de la table users
function createTableUsers()
{

    $pdo = connexionBdd();

    $sql = " CREATE TABLE IF NOT EXISTS users (
         id_user INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
         firstName VARCHAR(50),
         lastName VARCHAR(50) NOT NULL,
         pseudo VARCHAR(50) NOT NULL,
         mdp VARCHAR(255) NOT NULL,
         email VARCHAR(100) NOT NULL,
         phone VARCHAR(30) NOT NULL,
         civility ENUM('f', 'h') NOT NULL,
         birthday date NOT NULL,
         address VARCHAR(50) NOT NULL,
         zip VARCHAR(50) NOT NULL,
         city VARCHAR(50) NOT NULL,
         country VARCHAR(50),
         role ENUM('ROLE_USER','ROLE_ADMIN') DEFAULT 'ROLE_USER' 
         )";
    $request = $pdo->exec($sql);
}

createTableUsers();

#############################cREATION DE CLES ETRANGERES#############################

// ALTER TABLE ORDERS ADD FOREIGN KEY (Customer_SID) REFERENCES CUSTOMER (SID);

//$tableF : table ou on va lcréer la clé étrangère 
//$tableP : table à partir de lequelle on récupère la clé primaire
//$keyF : la clé étrangère
//$keyP : la clé primaire

function foreignKey($tableF, string $keyF, $tableP,string $keyP){

    $cnx = connexionBDD();
    $sql = "ALTER TABLE $tableF ADD FOREIGN KEY ($keyF) REFERENCES $tableP ($keyP)";
    $request = $cnx->exec($sql);
}
// Création de la clé étrangère dans la table films
// foreignKey('films', 'category_id', 'categories', "id_category");


#############################Fonctions du CRUD pour les utilisateurs#############################

//<Inscription

function inscriptionUsers(string $lastName, string $firstName, string $pseudo, string $email, string $phone, string $mdp, string $civility, string $birthday, string $address, string $zip, string $city, string $country) : void{

    /*Les requêtes préparer sont préconisées si vous exécutez plusieurs fois la même requête. Ainsi vous évitez au SGBD de répéter toutes les phases analyse/ interpretation / exécution de la requête (gain de performance). Les requêtes préparées sont aussi utilisées pour nettoyer les données et se prémunir des injections de type SQL.
        1- On prépare la requête
        2- On lie le marqueur à la requête
        3- On exécute la requête




    */


    $cnx = connexionBDD();
    $sql = "INSERT INTO users
    (lastName, firstName, pseudo, email, phone, mdp, civility, birthday, address, zip, city, country) VALUES (:lastName, :firstName, :pseudo, :email, :phone, :mdp, :civility, :birthday, :address, :zip, :city, :country)";

    $request = $cnx -> prepare($sql);
    //prepare() est une méthode qui permet de préparer la requête sans l'exécuter. Elle contient un marqueur :nom qui est vide et attend une valeur.
    //$requet est à cette ligne  encore un objet PDOstatement.
    
    $request->execute(array(
        ":lastName"=>$lastName, 
        ":firstName"=>$firstName, 
        ":pseudo"=> $pseudo,
        ":email"=> $email,
        ":phone"=> $phone,
        ":mdp"=> $mdp,
        ":civility"=>$civility, 
        ":birthday"=>$birthday, 
        ":address"=>$address, 
        ":zip"=>$zip, 
        ":city"=>$city, 
        ":country"=>$country,
    ));//execute() permet d'éxecuter toute la requête préparée avec prepare()
}
// inscriptionUsers();



/////////////////////////////Une fonction pour vérifier si le email existe déjat dans la BDD//////////////////////////////////////////////////


function checkEmailUser(string $email) :mixed{

    $cnx = connexionBDD();
    $sql = "SELECT * FROM users WHERE email = :email";
    $request = $cnx ->prepare($sql);
    $request -> execute(array(
        ':email' => $email
    ));

    $result = $request->fetch(PDO::FETCH_ASSOC);//Le paramètre  PDO::FETCH_ASSOC permet de transformer l'objet en un array ASSOCIATIF.On y trouve en indices le nom des champs de la requête SQL.
    /**
     * Pour informatrion, on peut mettre dans les parenthése de fecth()
     * PDO::FETCH_NUM pour obtenir un tableau aux indices numèrique
     * PDO::FETCH_OBJ pour obtenir un dernier objet
     * ou encore des () vides pour obtenir un mélange de tableau associatif et indéxé
     */

    return $result;
}


/////////////////////////////Une fonction pour vérifier si l'user' existe déjat dans la BDD//////////////////////////////////////////////////


function checkPseudoUser(string $pseudo)  {
    // Connexion à la base de données
    $cnx = connexionBDD();
    
    // Préparation de la requête SQL pour vérifier l'utilisateur par email et nom d'utilisateur
    $sql = "SELECT * FROM users WHERE pseudo = :pseudo";
    $request = $cnx->prepare($sql);
    
    // Exécution de la requête avec les paramètres fournis
    $request->execute(array(
        
        ':pseudo' => $pseudo
    ));
    
    // Récupération du résultat
    $result = $request->fetch();
    
    // Si un résultat est trouvé, cela signifie que l'utilisateur existe
    return $result;
}


/////////////////////////Une fonction pour vérifier un utilisateur dans la BDD

function checkUser(string $pseudo, string $email) : mixed {

    $cnx = connexionBDD();
    $sql = "SELECT * FROM users WHERE pseudo = :pseudo AND email = :email";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ":pseudo" => $pseudo,
        ":email" => $email
    ));
    $result = $request->fetch();// On peut éviter de mettre cette constanyte comme paramètre de la mèthode fetch() à chaque fois en la définissant dans la connexion de la BDD par défaut (dans le try de la connexion à la BDD -> voir fonction connexionBdd())

    return $result;
}

?>