<?php

require_once "../inc/function.inc.php";

class JeuVideo{
    /**
     * Le nom du jeu
     *
     * @var string
     */
    private string $nomDuJeu;
    /**
     * Le nom de la console
     *
     * @var string
     */
    private string $console;
    /**
     * Le prix du jeu
     *
     * @var string
     */
    private float $prix;



    /**
     * Le constructeur de la casee
     * 
     * Le constructeur est une méthode spéciale dans une classe, définie avec le nom __construct().
     * Elle est utilisée pour initialiser les propriétés de l'objet lors de sa création.
     * En PHP, il s'agit d'une méthode magique, ce qui signifie qu'elle est automatiquement appelée lors de l'instanciation de la classe.
     * Il est important de noter qu'une classe ne peut avoir qu'un seul constructeur en PHP.
     *
     * @param string $n le nom du jeu
     * @param string $c le modèle de la console
     * @param float $p le prix du jeu
     */

    
    
    public function __construct(string $n, string $c, float $p){

        // Initialisation des propriétées de l'objet avec les valeurs fournies lors de l'instanciation
        $this->nomDuJeu = $n;
        $this->console = $c;
        $this->prix = $p;
    }


    /**
     * Méthode pour obtenir le nom du jeu vidéo
     *
     * @return string
     */
    public function getNomDuJeu() : string{

        return $this->nomDuJeu;

    }

    /**
     * Méthode pour obtenir la console du jeu vidéo
     *
     * @return string
     */
    public function getConsole() : string{

        return $this->console;

    }

    /**
     * Méthode pour obtenir le prix du jeu vidéo
     *
     * @return string
     */
    public function getPrix() : float{

        return $this->prix;

    }


    /**
     * Méthode pour afficher les détails du jeu vidéo
     *
     * @return void
     */
    public function afficheDetails(){

        return "<p>Jeux : {$this->nomDuJeu}, console : {$this->console}, peix : {$this->prix}€</p>";
    }

}


//Instantiation de la classe JeuVideo avec arguments pour initialiser les propriétées
$jeu_1 = new JeuVideo('street Fighter 6', 'PS4', 69.99);
debug($jeu_1);

$jeu_2 = new JeuVideo('Diablo IV', 'PS5', 79.99);
debug($jeu_2);

echo $jeu_1->afficheDetails();
echo $jeu_2->afficheDetails();


