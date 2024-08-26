<?php

class Personne{


     /**
     * Le nom de la personne (propriété protégée)
     *
     * @var string
     */
    protected string $nom;


    /**
     * Constructeur de la classe Personne
     *
     * @param string $n
     */
    public function __construct($n){

    
        $this->nom = $n;
    }



    /**
     * Affiche le nom de la personne
     *
     * @return string
     */
    protected function afficheNom():string{

        return "Nom : {$this->nom}";
    }


}


class Etudiant extends Personne {

    /**
     * L'Age de l'étudiant
     *
     * @var integer
     */
    private int $age;


    /**
     * Undocumented function
     *
     * @param string $nom
     * @param int $age
     */
    public function __construct($nom, $age){

        parent::__construct($nom);//Appel du constructeur de la classe de base parente (Personne depuis la class enfant)
        $this->age = $age;
    }

    /**
     * Affiche les informations de l'étudiant, y compris le nom et l'age
     *
     * @return string
     */
    public function afficheInfo():string{

        return $this->afficheNom() . "âge : " . $this->age;
    }



}

$etudiant1 = new Etudiant("Spartak", 29);

echo $etudiant1->afficheInfo();










