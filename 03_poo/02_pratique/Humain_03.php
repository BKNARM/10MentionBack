<?php

require_once "../inc/function.inc.php";



//GETTER et SETTER

/**
 * Une classe réprésentant un humain avec des propriétés privées pour le prénom et le nom
 * Les propriétés privées sont accédées et modifiées via des méthodes publiques appelées getter et setter
 */

 class Humain{

    /**
     * Le prénom de l'humain
     * 
     * @var string
     */
    private string $prenom;

    /**
     * Le nom de l'humain
     * 
     * @var string 
     */
    private string $nom;

    /*
    Les propriétés étant 'private', il est nécessaire de passer par des méthodes 'publiques' pour pouvoir lire et écrire ces propriétés.
    On parle de Getter (lire / récupérer) et de Setter (écrire / définir) : ce sont des méthodes qui vont faire la médiation (l'intermédiaire) entre l'extérieur de la classe et ses attributs.
    $this désigne l'objet courant à l'intérieur de la classe.
    */

    /**
     * Définit le prénom de l'humain
     * 
     * @param string
     * @return void
     */

    public function setPrenom(string $p) : void{// par convention, on appel la fonction avec le mot-clé "set"

        if (is_string($p)) {//si c'est une chaine de caractère je rentre dans la condition


            // mot clef $this est une "pseudo-variable" , elle va être remplacée par l'objet courrament utilisé. 
            // $this  est créer automatiquement et qui représente l'insctance courante
            $this->prenom = $p;//assigne la valeur de $p à la propriété $ prenom

        }




    }

    public function getPrenom() : string {// par convention, on appel la fonction avec le mot-clé "get"

        return $this->prenom;




    }


    /**
     * Définit le nom de l'humain
     * 
     * @param string
     * @return void
     */

    public function setNom(string $n) : void{// par convention, on appel la fonction avec le mot-clé "set"

        if (is_string($n)) {//si c'est une chaine de caractère je rentre dans la condition


            // mot clef $this est une "pseudo-variable" , elle va être remplacée par l'objet courrament utilisé. 
            // $this  est créer automatiquement et qui représente l'insctance courante
            $this->nom = $n;//assigne la valeur de $p à la propriété $ prenom

        }




    }

    public function getNom() : string {// par convention, on appel la fonction avec le mot-clé "get"

        return $this->nom;




    }

    


 }

 $personne_1 = new Humain();

 // $personne_1->prenom = "Sahar"
 // echo $personne_1->prenom; //accés directe aux propriétées non autorisées


 // Utilisation de la méthode setPrenom() pour définir le prénom de l'humain
 $personne_1->setPrenom("Sahar");


 //Utilisation de la méthode getPrenom() pour récupérer et afficher le nom de l'humain
 echo $personne_1->getPrenom();

 
 // Utilisation de la méthode setNom() pour définir le nom de l'humain
 $personne_1->setNom(" Ferchichi");


 //Utilisation de la méthode getPrenom() pour récupérer et afficher le nom de l'humain
 echo $personne_1->getNom();

 echo "<p>Bonjour je m'appel {$personne_1->getPrenom()} {$personne_1->getNom()}</p>"


 


?>