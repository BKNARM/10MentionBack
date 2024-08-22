<?php
//////////////////////////// Exercice 1 //////////////////////////////////////

/* 
    Créez une classe Calculatrice avec deux méthodes : additionner et diviser. 
    Vous devrez ajouter des commentaires de documentation 
    Méthode additionner :   La méthode doit retourner un int, qui est la somme des deux nombres.
    Méthode diviser : La méthode doit retourner un float si la division est possible. Si le diviseur est zéro, la méthode doit retourner false.
*/

class Calculatrice{


    
    /**
     * Additioner deux nombres
     *
     * @param integer $nbr1
     * @param integer $nbr2
     * @return integer
     */
    public function operationAdition(int $nbr1, int $nbr2) :int {

        return $nbr1 + $nbr2;
        

    }

    

    public function operationDivision(float $nbr1, float $nbr2) :mixed{

        if ($nbr2 == 0) {
            return false;
        }

        return $nbr1 / $nbr2;
    }
    

}

$calcul = new Calculatrice();

$addition = $calcul->operationAdition(10,2);
echo $addition . "<br>";

$division = $calcul->operationdivision(10,2);
echo $division;



//////////////////////////// Exercice 2  //////////////////////////////////////

/*
    Créez un objet $fruit_1 à partir de la classe Fruit avec les propriétés suivantes : "Fraise" pour le nom et "rouge" pour la couleur.
    Vous devrez ajouter des commentaires de documentation 
    La classe Fruit doit contenir les propriétés privées $nom et $couleur.
    La classe doit également inclure un constructeur pour initialiser ces propriétés.
    Affichez les valeurs des propriétés "Fraise" et "rouge" de l'objet $fruit_1 en utilisant un echo.
*/




?>  