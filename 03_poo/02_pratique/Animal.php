<?php




/**
 * La visibilité protected est un niveau d'accès intermédiaire qui permet à une propriété ou une méthode d'être accessible uniquement :

 *À l'intérieur de la classe où elle est définie.
 *Dans les classes filles (sous-classes) qui héritent de cette classe.
 */
/**
 * Classe Animal
 *
 * Représente un animal générique avec un nom.
 */
class Animal {
    /**
     * Le nom de l'animal (propriété protégée)
     *
     * @var string
     */
    protected string $nom;


    /**
     * Constructeur de la classe Animal
     *
     * @param string $n
     */
    public function __construct($n){

    
        $this->nom = $n;
    }



    /**
     * Méthode protégée pour obtenir une description générique de l'animal
     *
     * @return string
     */
    protected function description(){

        return "Ceci est un animal nommé {$this->nom}";
    }



    /**
     * Méthode protégée pour obtenir le nom de l'animal
     *
     * @return void
     */
    public function getNom():string{

        return $this->nom;
    }

}

/**
 * Class Dog qui hérite de la classe Animal
 */
class Dog extends Animal{// Elle étends la classe Animal et hérit de ses propriétés et méthodes protégées


    /**
     * Méthode publique pour obtenir le son spécifique d'un chien
     *
     * @return string
     */
    public function affichage(){

        //Accés à la propriété protégé $nom et àla méthode protégée description de la classe parente
        return $this->nom ."\nDit Wouf\n". $this->description();
    }


}

$chien = new Dog("Djaba");//instenciation de la classe
echo $chien->getNom()."<br>";//affiche le nom

echo $chien->affichage();