<!-- fichier qui contient les fonctions php à utiliser dans notre site -->

<?php

session_start();

#############################constante pour definir le chemin du site#############################


 // constante qui définit les dosiiers dans lesquels se situe le site pour pouvoir déterminer des chemins absolus à partir de localhost (on ne prends localhost). Ainsi nous écrivons tous les chemins (exp : src, href ) en absolu avec cette constante

define("RACINE_SITE", "http://localhost/10MentionBack/02_php/site_cinema/");



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



#############################Fonction pour la deconnexion#############################

function logOut(){
    if(isset($_GET['action']) && $_GET['action'] == "deconnexion"){
        unset($_SESSION['user']);
        header('location:'.RACINE_SITE. 'index.php'); 
    }
}

logOut();


#############################Fonction pour la connexion à la BDD#############################

// On va utiliser l'extension PHP Data Objects (PDO), elle définit une excellente interface pour accéder à une base de données depuis PHP et d'exécuter des requêtes SQL .
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

    //Grâce à PDO(classe native PHP) on peut lever une exception (une erreur) si la connexion à la BDD ne se réalise pas(exp: suite à une faute au niveau du nom de la BDD) et par la suite si elle cette erreur est capté on lui demande d'afficher une erreur

    try { // dans le try on vas instancier PDO, c'est créer un objet de la classe PDO (un élment de PDO)
        // avec la variable dsn et les constatntes d'environnement
        $pdo = new PDO($dsn, DBUSER, DBPASS); //dsn = data source mail
        // echo "je suis connecté";

        //On définit le mode d'erreur de PDO sur Exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) { // PDOException est une classe qui représente une erreur émise par PDO et $e c'est l'objet de la classe en question qui vas stocker cette erreur
        die("Erreur : " . $e->getMessage()); // die d'arrêter le PHP et d'afficher une erreur en utilisant la méthode getmessage de l'objet $e
    }

    //le catch sera exécuter dès lors on aura un problème dans le try


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



#############################Fonction string array#############################


function stringToArray(string $string ) :array{
    
    $array = explode('/', trim($string, '/')); // Je transforme ma châine de caractére en tableau et je supprime les / autour de la chaîne de caractére 
    return $array; // ma fonction retourne un tableau

}





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

    // Créer un tableau associatif avec les noms des colonnes comme clés
    // Les noms des clés du tableau $data correspondent aux noms des colonnes dans la base de données.
    
    $data = [
        'firstName' => $firstName,
        'lastName' => $lastName,
        'pseudo' => $pseudo,
        'mdp' => $mdp,
        'email' => $email,
        'phone' => $phone,
        'civility' => $civility,
        'birthday' => $birthday,
        'address' => $address,
        'zip' => $zip,
        'city' => $city,
        'country' => $country
    ];

    // echapper les données et les traiter contre les failles JS (XSS)

    foreach ($data as $key => $value) {

        $data[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        
        // 1 -> $data['firstName] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        /* 
            htmlspecialchars est une fonction qui convertit les caractères spéciaux en entités HTML, cela est utilisé afin d'empêcher l'exécution de code HTML ou JavaScript : les attaques XSS (Cross-Site Scripting) injecté par un utilisateur malveillant en échappant les caractères HTML potentiellement dangereux . Par défaut, htmlspecialchars échappe les caractères suivants :

            & (ampersand) devient &amp;
            < (inférieur) devient &lt;
            > (supérieur) devient &gt;
            " (guillemet double) devient &quot;*/

        /*
            ENT_QUOTES : est une constante en PHP  qui onvertit les guillemets simples et doubles. => ' (guillemet simple) devient &#039; 
            'UTF-8' : Spécifie que l'encodage utilisé est UTF-8.
        */
    }




    $cnx = connexionBDD();
    $sql = "INSERT INTO users
    (lastName, firstName, pseudo, email, phone, mdp, civility, birthday, address, zip, city, country) VALUES (:lastName, :firstName, :pseudo, :email, :phone, :mdp, :civility, :birthday, :address, :zip, :city, :country)";

    $request = $cnx -> prepare($sql);
    //prepare() est une méthode qui permet de préparer la requête sans l'exécuter. Elle contient un marqueur :nom qui est vide et attend une valeur.
    //$requet est à cette ligne  encore un objet PDOstatement.
    
    $request->execute(array(
        ':firstName' => $data['firstName'],
        ':lastName' => $data['lastName'],
        ':pseudo' => $data['pseudo'],
        ':mdp' => $data['mdp'],
        ':email' => $data['email'],
        ':phone' => $data['phone'],
        ':civility' => $data['civility'],
        ':birthday' => $data['birthday'],
        ':address' => $data['address'],
        ':zip' => $data['zip'],
        ':city' => $data['city'],
        ':country' => $data['country'],
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



############################################Fonction pour récupérer tout les utilisateurs###########################################

function allUsers ():mixed {

    $cnx = connexionBDD();
    $sql = "SELECT * FROM users";
    $request = $cnx->query($sql);
    $result = $request->fetchAll();


    return $result;// fetchAll() récupère tout les résultats dans la reqûête et les sort sous forme d'un tableau à 2 dismensions

}


############################################Fonction pour supprimer un utilisateur###########################################

function deleteUser(int $id_user) :void{
    
        
        $cnx = connexionBDD();
        
        
        $sql = "DELETE FROM users WHERE id_user = :id_user";
        $request = $cnx->prepare($sql);
        
        
        $request->execute(array(
            ':id_user' => $id_user
        ));
        $result = $request->fetch();
        
    
}
############################################Fonction pour supprimer un utilisateur###########################################

function updateRole(string $role, int $id_user) :void{
    
        
    $cnx = connexionBDD();
    $sql = "UPDATE users SET role = :role WHERE id_user = :id_user";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ':role' => $role,
        ":id_user" => $id_user
    ));
    
    

}
######################################################### fonction pour recupperer un seul utilisateur###################################################

function showUser(int $id_user) :mixed{
    
        
    $cnx = connexionBDD();
    $sql = "SELECT * FROM users WHERE id_user = :id_user";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ":id_user" => $id_user
    ));
    $result = $request->fetch();
    return $result;
    
    

}

###################################################Fonction pour les categories##########################################################################


function lesCategories ():mixed {

    $cnx = connexionBDD();
    $sql = "SELECT * FROM categories";
    $request = $cnx->query($sql);
    $result = $request->fetchAll();


    return $result;// fetchAll() récupère tout les résultats dans la reqûête et les sort sous forme d'un tableau à 2 dismensions

}


function ajoutCategories(string $name, string $description ) : void{

    


    $cnx = connexionBDD();
    $sql = "INSERT INTO categories (name, description) VALUES (:name, :description)";

    $request = $cnx -> prepare($sql);
    
    
    $request->execute(array(
        ":name"=>$name,
        ":description"=>$description 
        
    ));
}

#######################################Fonction modification user#############################################################

function modificationUsers(string $lastName, string $firstName, string $pseudo, string $email, string $phone, string $mdp, string $civility, string $birthday, string $address, string $zip, string $city, string $country) : void{

 
    $data = [
        'firstName' => $firstName,
        'lastName' => $lastName,
        'pseudo' => $pseudo,
        'mdp' => $mdp,
        'email' => $email,
        'phone' => $phone,
        'civility' => $civility,
        'birthday' => $birthday,
        'address' => $address,
        'zip' => $zip,
        'city' => $city,
        'country' => $country
    ];

   

    foreach ($data as $key => $value) {

        $data[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        
        
    }




    $cnx = connexionBDD();
    $sql = "UPDATE users
    (lastName, firstName, pseudo, email, phone, mdp, civility, birthday, address, zip, city, country) VALUES (:lastName, :firstName, :pseudo, :email, :phone, :mdp, :civility, :birthday, :address, :zip, :city, :country)";

    $request = $cnx -> prepare($sql);
   
    
    $request->execute(array(
        ':firstName' => $data['firstName'],
        ':lastName' => $data['lastName'],
        ':pseudo' => $data['pseudo'],
        ':mdp' => $data['mdp'],
        ':email' => $data['email'],
        ':phone' => $data['phone'],
        ':civility' => $data['civility'],
        ':birthday' => $data['birthday'],
        ':address' => $data['address'],
        ':zip' => $data['zip'],
        ':city' => $data['city'],
        ':country' => $data['country'],
    ));
}






function showCategory(string $name){

    $cnx = connexionBdd();
    $sql = "SELECT * FROM categories WHERE name = :name";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ":name" => $name
    ));
    $result = $request->fetch();
    return $result;

}

///////////////////////////////////////////  fonction pour insérer une catégorie //////////////////////////////////////////

function addCategory(string $nameCategory, string $description) : void {

    $pdo = connexionBdd();
    $sql= "INSERT INTO categories (name, description) VALUES (:name, :description)"; // requête d'insertion que je stock dans une variable
    $request = $pdo->prepare($sql); // je prépare ma fonction et je l'exécute
    $request->execute(array(

            ':name' => $nameCategory,
            ':description' => $description
    ));

}

//////////////////////////////////////// Une fonction pour récupérer toutes les catégories //////////////////////////////////////////////

function allCategories() : mixed{
        
    $pdo = connexionBdd();
    $sql= "SELECT * FROM categories"; // requête d'insertion que je stock dans une variable
    $request = $pdo->query($sql); 
    $result = $request->fetchAll();// j'utilise fetchAll() pour récupérer toute les ligne à la fois 
    return $result; // ma fonction retourne un tableau ave les données récupérer de la BDD
}

//////////////////////////////////////// Une fonction pour supprimer une catégorie//////////////////////////////////////////////

function deleteCategory(int $id) :void {

    $pdo = connexionBdd();
    $sql = "DELETE FROM categories WHERE id_category = :id";
    $request = $pdo->prepare($sql);
    $request->execute(array(
        ':id' => $id
    ));


}

//////////////////////////////////////// Une fonction pour modifier une catégorie//////////////////////////////////////////////


function updateCategory(int $id, string $name, string $description) :void {

    $pdo = connexionBdd();
    $sql = "UPDATE categories SET name = :name, description = :description WHERE id_category = :id";
    $request = $pdo->prepare($sql);
    $request->execute(array(
        ':id' => $id,
        ':name'=> $name,
        ':description' => $description
    ));


}


//////////////////////////////////////// Une fonction pour modifier une catégorie//////////////////////////////////////////////

function showCategoryViaId(int $id) :mixed {

    $pdo = connexionBdd();
    $sql = "SELECT * FROM categories WHERE id_category = :id_category";
    $request = $pdo->prepare($sql);
    $request->execute(array(
        ':id_category' => $id
        
    ));
    $result = $request->fetch();
    return $result;


}

//////////////////////////////////////// Fonctions CRUD pour inserer les films//////////////////////////////////////////////

//////////////////////////////////////// Fonction pour insérer un film//////////////////////////////////////////////

function insertFilm(int $category_id, string $titleFilm, string $director, string $actors, string $duration, string $synopsis, string $dateSortie, float $price, int $stock, string $ageLimit, string $image) : void{


    

    /*Les requêtes préparer sont préconisées si vous exécutez plusieurs fois la même requête. Ainsi vous évitez au SGBD de répéter toutes les phases analyse/ interpretation / exécution de la requête (gain de performance). Les requêtes préparées sont aussi utilisées pour nettoyer les données et se prémunir des injections de type SQL.
        1- On prépare la requête
        2- On lie le marqueur à la requête
        3- On exécute la requête
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
    */

    // Créer un tableau associatif avec les noms des colonnes comme clés
    // Les noms des clés du tableau $data correspondent aux noms des colonnes dans la base de données.
    
    $films = [
        'category_id'=> $category_id,
        'title' => $titleFilm,
        'director' => $director,
        'actors' => $actors,
        // 'categories ' => $genre,
        'duration' => $duration,
        'synopsis' => $synopsis,
        'date' => $dateSortie,
        'price' => $price,
        'stock' => $stock,
        'ageLimit' => $ageLimit,
        'image' => $image
        
    ];

    // echapper les données et les traiter contre les failles JS (XSS)

    foreach ($films as $key => $value) {

        $data[$key] = htmlentities($value);
        
        // 1 -> $data['firstName] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        /* 
            htmlspecialchars est une fonction qui convertit les caractères spéciaux en entités HTML, cela est utilisé afin d'empêcher l'exécution de code HTML ou JavaScript : les attaques XSS (Cross-Site Scripting) injecté par un utilisateur malveillant en échappant les caractères HTML potentiellement dangereux . Par défaut, htmlspecialchars échappe les caractères suivants :

            & (ampersand) devient &amp;
            < (inférieur) devient &lt;
            > (supérieur) devient &gt;
            " (guillemet double) devient &quot;*/

        /*
            ENT_QUOTES : est une constante en PHP  qui onvertit les guillemets simples et doubles. => ' (guillemet simple) devient &#039; 
            'UTF-8' : Spécifie que l'encodage utilisé est UTF-8.
        */
    }




    $cnx = connexionBDD();
    $sql = "INSERT INTO films
    (category_id, title, director, actors, duration, synopsis, date, price, stock, ageLimit, image) VALUES (:category_id, :title, :director, :actors, :duration, :synopsis, :date, :price, :stock, :ageLimit, :image)";

    $request = $cnx -> prepare($sql);
    //prepare() est une méthode qui permet de préparer la requête sans l'exécuter. Elle contient un marqueur :nom qui est vide et attend une valeur.
    //$requet est à cette ligne  encore un objet PDOstatement.
    
    $request->execute(array(
        ':category_id' => $data['category_id'],
        ':title' => $data['title'],
        ':director' => $data['director'],
        ':actors' => $data['actors'],
        // ':genre' => $data['genre'],
        ':duration' => $data['duration'],
        ':synopsis' => $data['synopsis'],
        ':date' => $data['date'],
        ':price' => $data['price'],
        ':stock' => $data['stock'],
        ':ageLimit' => $data['ageLimit'],
        ':image' => $data['image']
        
    ));//execute() permet d'éxecuter toute la requête préparée avec prepare()
}

//////////////////////////////////////// Fonction pour insérer un film//////////////////////////////////////////////

function allFilm() : mixed{
        
    $pdo = connexionBdd();
    $sql= "SELECT * FROM films"; // requête d'insertion que je stock dans une variable
    $request = $pdo->query($sql); 
    $result = $request->fetchAll();// j'utilise fetchAll() pour récupérer toute les ligne à la fois 
    return $result; // ma fonction retourne un tableau ave les données récupérer de la BDD
}



//////////////////////////////////////// Fonction pour supprimer un film//////////////////////////////////////////////


function deleteFilm(int $id) :void {

    $pdo = connexionBdd();
    $sql = "DELETE FROM films WHERE id_film = :id";
    $request = $pdo->prepare($sql);
    $request->execute(array(
        ':id' => $id
    ));


}


//////////////////////////////////////// Fonction pour modifier un film//////////////////////////////////////////////


function showFilm(int $id_film) {

    $pdo = connexionBdd();
    $sql = "SELECT * FROM films WHERE id_film = :id_film";
    $request = $pdo->prepare($sql);
    $request->execute(array(
        ':id_film' => $id_film,
        
    ));
    $result = $request->fetch();
    return $result;


}


//////////////////////////////////////// Fonction vérifiér sin un filme existe ou pas dans la Bdd//////////////////////////////////////////////


function verifFilm(string $title, string $date ) :mixed{

    $pdo = connexionBdd();
    $sql = "SELECT * FROM films WHERE title = :title AND date = :date";
    $request = $pdo->prepare($sql);
    $request->execute(array(
        ':title' => $title,
        ':date'=> $date
        
    ));
    $result = $request->fetch();
    return $result;




}

//////////////////////////////////////// Fonction vérifiér sin un filme existe ou pas dans la Bdd//////////////////////////////////////////////


function modifierFilm(int $category_id, string $titleFilm, string $director, string $actors, string $duration, string $synopsis, string $dateSortie, float $price, int $stock, string $ageLimit, string $image) : void{


    

    /*Les requêtes préparer sont préconisées si vous exécutez plusieurs fois la même requête. Ainsi vous évitez au SGBD de répéter toutes les phases analyse/ interpretation / exécution de la requête (gain de performance). Les requêtes préparées sont aussi utilisées pour nettoyer les données et se prémunir des injections de type SQL.
        1- On prépare la requête
        2- On lie le marqueur à la requête
        3- On exécute la requête
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
    */

    // Créer un tableau associatif avec les noms des colonnes comme clés
    // Les noms des clés du tableau $data correspondent aux noms des colonnes dans la base de données.
    
    $films = [
        'category_id'=> $category_id,
        'title' => $titleFilm,
        'director' => $director,
        'actors' => $actors,
        // 'categories ' => $genre,
        'duration' => $duration,
        'synopsis' => $synopsis,
        'date' => $dateSortie,
        'price' => $price,
        'stock' => $stock,
        'ageLimit' => $ageLimit,
        'image' => $image
        
    ];

    // echapper les données et les traiter contre les failles JS (XSS)

    foreach ($films as $key => $value) {

        $data[$key] = htmlentities($value);
        
        // 1 -> $data['firstName] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        /* 
            htmlspecialchars est une fonction qui convertit les caractères spéciaux en entités HTML, cela est utilisé afin d'empêcher l'exécution de code HTML ou JavaScript : les attaques XSS (Cross-Site Scripting) injecté par un utilisateur malveillant en échappant les caractères HTML potentiellement dangereux . Par défaut, htmlspecialchars échappe les caractères suivants :

            & (ampersand) devient &amp;
            < (inférieur) devient &lt;
            > (supérieur) devient &gt;
            " (guillemet double) devient &quot;*/

        /*
            ENT_QUOTES : est une constante en PHP  qui onvertit les guillemets simples et doubles. => ' (guillemet simple) devient &#039; 
            'UTF-8' : Spécifie que l'encodage utilisé est UTF-8.
        */
    }




    $cnx = connexionBDD();
    $sql = "UPDATE films SET
    (category_id, title, director, actors, duration, synopsis, date, price, stock, ageLimit, image) VALUES (:category_id, :title, :director, :actors, :duration, :synopsis, :date, :price, :stock, :ageLimit, :image, category_id = :category_id WHERE id_film = :id_film)";

    $request = $cnx -> prepare($sql);
    //prepare() est une méthode qui permet de préparer la requête sans l'exécuter. Elle contient un marqueur :nom qui est vide et attend une valeur.
    //$requet est à cette ligne  encore un objet PDOstatement.
    
    $request->execute(array(
        ':category_id' => $data['category_id'],
        ':title' => $data['title'],
        ':director' => $data['director'],
        ':actors' => $data['actors'],
        // ':genre' => $data['genre'],
        ':duration' => $data['duration'],
        ':synopsis' => $data['synopsis'],
        ':date' => $data['date'],
        ':price' => $data['price'],
        ':stock' => $data['stock'],
        ':ageLimit' => $data['ageLimit'],
        ':image' => $data['image']
        
    ));//execute() permet d'éxecuter toute la requête préparée avec prepare()
}



#####################################################fonction FILMS BY DATE###########################################################################

function filmByDate() :mixed{
    $cnx = connexionBDD();
    $sql = "SELECT * FROM films ORDER BY date DESC LIMIT 6";
    $request = $cnx -> query($sql);
   $result= $request ->fetchAll();
    return $result;

}




#########################################################Films BY CATEGORY############################################################################################



function filmsByCategory($id){

    $cnx = connexionBDD();
    $sql = "SELECT * FROM films WHERE category_id = :id";
    $request = $cnx -> prepare($sql);
    $request ->execute(array(
            ':id' => $id
    ));
    $result = $request -> fetchAll();
    return $result;

}


#########################################################fonction pour afficher les films des differents categories############################################################################################


function afficherFilms($id){

    $cnx = connexionBDD();
    $sql = "SELECT * FROM films WHERE category_id = :id";
    $request = $cnx -> prepare($sql);
    $request ->execute(array(
            ':id' => $id
    ));

}







?>