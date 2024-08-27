<?php

// Exercice 1:
// Créez une classe de base "Employe" qui représente un employé d'une entreprise. Ensuite, créez des classes dérivées pour des types spécifiques d'employés : "Manager" et "Developpeur".

// La classe Employe doit avoir les propriétés protected suivantes : $nom et $salaire.
// Ajoutez un constructeur qui initialise ces propriétés.
// Ajoutez une méthode protected nommée afficherDetails() qui retourne une chaîne de caractères avec le nom et le salaire.
// Créez une classe Manager qui hérite de Employe.

// Ajoutez une propriété private pour le nombre d'employés sous sa supervision, $nbEmployes.
// Ajoutez un constructeur pour initialiser le nom, le salaire et le nombre d'employés.
// Ajoutez une méthode public nommée afficherInfos() qui utilise la méthode afficherDetails() de la classe Employe et ajoute le nombre d'employés.
// Créez une classe Developpeur qui hérite également de Employe.

// Ajoutez une propriété private pour le langage de programmation préféré, $langage.
// Ajoutez un constructeur pour initialiser le nom, le salaire et le langage.
// Ajoutez une méthode public nommée afficherInfos() qui utilise la méthode afficherDetails() de la classe Employe et ajoute le langage de programmation.
// Instanciez des objets Manager et Developpeur et affichez leurs informations en utilisant les méthodes afficherInfos().


class Employe{

    protected string $nom;
    protected int $salaire;

    public function _construct(string $n, int $s){

        $this->nom = $n;
        $this->salaire = $s;
    }

    public function getNom(){

        return $this->nom;
    }

    protected function afficherDetails(){

       return $this->nom;
    }

}



class Manager extends Employe{


    public function afficherInfos(){

        return "{$this->afficherDetails()}";
    }


}

$salarie1 = new Manager("semir",1500);

echo $salarie1->afficherInfos();



// Exercice 2:
// Créez une classe de base "Vehicule" qui représente un véhicule général. Ensuite, créez des classes dérivées pour des types spécifiques de véhicules : "Voiture" et "Moto".

// La classe Vehicule doit avoir les propriétés protected suivantes : $marque et $modele.
// Ajoutez un constructeur qui initialise ces propriétés.
// Ajoutez une méthode protected nommée afficherDetails() qui retourne une chaîne de caractères avec la marque et le modèle.
// Créez une classe Voiture qui hérite de Vehicule.

// Ajoutez une propriété private pour le nombre de portes, $nbPortes.
// Ajoutez un constructeur pour initialiser la marque, le modèle et le nombre de portes.
// Ajoutez une méthode public nommée afficherInfos() qui utilise la méthode afficherDetails() de la classe Vehicule et ajoute le nombre de portes.
// Créez une classe Moto qui hérite également de Vehicule.

// Ajoutez une propriété private pour la cylindrée, $cylindree.
// Ajoutez un constructeur pour initialiser la marque, le modèle et la cylindrée.
// Ajoutez une méthode public nommée afficherInfos() qui utilise la méthode afficherDetails() de la classe Vehicule et ajoute la cylindrée.
// Instanciez des objets Voiture et Moto et affichez leurs informations en utilisant les méthodes afficherInfos().


// Exercice 3:
// Créez une classe de base "Animal" qui représente un animal général. Ensuite, créez des classes dérivées pour des types spécifiques d'animaux : "Chien" et "Chat".

// La classe Animal doit avoir les propriétés protected suivantes : $nom et $age.
// Ajoutez un constructeur qui initialise ces propriétés.
// Ajoutez une méthode protected nommée afficherDetails() qui retourne une chaîne de caractères avec le nom et l'âge.
// Créez une classe Chien qui hérite de Animal.

// Ajoutez une propriété private pour la race, $race.
// Ajoutez un constructeur pour initialiser le nom, l'âge et la race.
// Ajoutez une méthode public nommée afficherInfos() qui utilise la méthode afficherDetails() de la classe Animal et ajoute la race.
// Créez une classe Chat qui hérite également de Animal.

// Ajoutez une propriété private pour la couleur du pelage, $couleur.
// Ajoutez un constructeur pour initialiser le nom, l'âge et la couleur.
// Ajoutez une méthode public nommée afficherInfos() qui utilise la méthode afficherDetails() de la classe Animal et ajoute la couleur du pelage.
// Instanciez des objets Chien et Chat et affichez leurs informations en utilisant les méthodes afficherInfos().

