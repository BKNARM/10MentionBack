<?php

class Fruit{

    /**
     * Le nom du fruit
     *
     * @var string
     */
    private string $nom;


    /**
     * la couleur du fruit
     *
     * @var string
     */
    private string $couleur;


    /**
     * Constructeur de la classe
     *
     * @param string $n
     * @param string $c
     */
    public function __construct(string $n, string $c){

        $this->nom = $n;
        $this->couleur = $c;

    }
    

    /**
     * Recu le nom du fruit
     *
     * @return void
     */
    public function getNomFruit() :string{

        return $this->nom;
    }

    /**
     * Recup la couleur du fruit
     *
     * @return string
     */
    public function getCouleur() :string{

        return $this->couleur;
    }


    /**
     * Affiche les détails du fruit
     *
     * @return string
     */
    public function afficheDetails() :string{

        return "<p> Nom du fruit : {$this->nom}; Couleur du fruit : {$this->couleur}</p>";
    }
    
}

//Création d'une instance de la classe Fruit avec les valeurs "Fraise" et "Rouge"

$fruit_1 = new Fruit("fraise", "Rouge");

//Afficher les informations du fruit en utilisant les méthodes getNom() et getCouleur()

echo $fruit_1->


