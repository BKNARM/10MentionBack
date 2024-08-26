<?php


require_once "../inc/function.inc.php";



//--------------------------Méthodes et propriétés STATIQUE ------------------//

/*
     
    -- Le mot static pour définir et préciser que la propriété ou la méthode appartient  seulement à la classe dans laquelle elle a été définie ( => ne vont pas appartenir à une instance de classe et par la suite à un objet qui stocke cette instance).
    -- Les méthodes et les propriétés STATIQUES vont avoir la même définition et la même valeur pour toutes les instances d'une classe .
    -- On peut  accéder  à ces éléments sans avoir besoin d'instancier la classe .
    -- Depuis un objet Il est impossible d'accéder à une propriété statique.
     On utilise les propriété et méthode statique quand on a pas besoin d'instnacier la classe plusieurs fois et stocker cette instanciation dans des objets différents
     cela nous permettre de partager de données communes entre toutes les instances d'une classe, optimiser des ressources et économiser de la mémoire quand les données changent pas et qui  doivent être partagées entre toutes les instances
     Exemple l'utilisation de la connexion à la BDD     
     
 */

class Maison
{

    /**
     * La surface du terrain
     *
     * @var string
     */
    public static string $espaceTerrain = '500m²';


    /**
     * La couleur de la maison
     *
     * @var string
     */
    public $couleur = 'blanc';

    const HAUTEUR = "10m";

    /**
     * Nombre de pièces dans la maison
     *
     * @var integer
     */
    private static $nbPiece = 7;


    /**
     * Nombre de portes dans la maison
     *
     * @var integer
     */
    private $nbPorte = 10;

    /**
     * Le nombre de pièce dans la maison
     *
     * @return int
     */
    public static function getNbPiece()
    {

        // Utilisation de self:: pour accéder à une propriété statique, il fait référence à la classe, contrairement à $this, qui fait référence à l'instance de l'objet.
        // Pour accéder au propriétés statique on utilise l'opérateur

        //Les méthodes statiques peuvent accéder aux propriétés statiques via le mot-clé self.

        return self::$nbPiece; // lors d'un self:: il faut mettre le $ devant la propriété appelé 'opérateur de résolution de portée' (::)

    }

    public function getNbPorte()
    {

        return $this->nbPorte;
    }
}

//Appel a la propriété $espaceTerrain de la class maison


//maison1  = new Maison(); //l'instenciation de la classe n'est pas obligatoire
echo "espaceTerrain : " . Maison::$espaceTerrain . "<hr>"; // Appel d'une propriété statique par la classe

$maison2  = new Maison();
echo "nbPiece : " . $maison2->getNbPiece() . "<hr>";

echo "nbPiece : " . Maison::getNbPiece() . "<hr>";

/**Création d'une instance de la classe Maison */

$maison2 = new Maison();

//Appel à la propriété Couleur

echo "couleur : " . $maison2->couleur . "<hr>";

//Affichage du nombre de porte dans la maison

echo "nbPorte: " . $maison2->getNbPorte() . "<hr>";


//appel de la constante HAUTEUR de la classe Maison


echo "Hauteur : " . Maison::HAUTEUR . "<hr>"; // les :: est utiliser pour les valeurs "statiques"

//echo Maison::$couleur; //Erreur : On ne peut pas appeler une propriété non statique par la classe


//echo Maison::getNbPorte();//Erreur : On ne peut pas appeler une méthode non statique (publique) par la classe.

echo $maison2->getNbPiece() . "<br>"; //On ne devrait pas pouvoir appeler une méthode statique par un objet, mais PHP permet cette action. cependant, il est préférable d'eviter cela pour de bonnes pratiques.

// Exemple d'utilisation de la propriété statique

class Compteur{


    /**
     * Total
     *
     * @var integer
     */
    public static $totalCount = 0;

    public function __construct(){

        self::$totalCount++;
    }


}

echo Compteur::$totalCount . "<br>";

$objet1 = new Compteur();

echo Compteur::$totalCount . "<br>";

$objet1 = new Compteur();

echo Compteur::$totalCount . "<br>";


//Exemple de configuration de BDD

class ConfigurationBDD{

    public static $dbName = "nomBDD";
    public static $dbUser = "user";
    public static $dbPassword = "mdp";
}

echo ConfigurationBDD::$dbName;
