<?php

class Media
{


    /**
     * Titre du film
     *
     * @var string
     */
    protected string $titre;


    /**
     * Nom de l'auteur
     *
     * @var string
     */
    protected string $auteur;

    public function __construct(string $t, string $a)
    {

        $this->titre = $t;
        $this->auteur = $a;
    }

    protected function description()
    {

        return "meilleur film de {$this->auteur}";
    }

    
    protected function afficheDetails():string
    {

        //Accés à la propriété protégé $nom et àla méthode protégée description de la classe parente
        return $this->titre . "\nest le meilleur film de\n" . $this->auteur;
    }
}


class Livre extends Media{


    private int $nbPages;


    public function __construct(string $a, string $t,int $nb)
    {
        $this->auteur = $a;
        $this->titre = $t;
        $this->nbPages = $nb;
        
    }

    public function getNbPages(){

        return $this->nbPages;
    }

    public function afficherInfos(){

        return "{$this->affichedetails()} , Nombre de pages : {$this->nbPages} pages";
    }

}

$livre1 = new Livre("Le petit Prince","ase", 96);

echo $livre1->afficherInfos() . "<br>";


//classe DVD


class Dvd extends Media{


    private int $duree;

    public function __construct(string $t, string $a, int $d)
    {
        $this->titre = $t;
        $this->auteur = $a;
        $this->duree = $d;
    }

    public function afficherInfos(){


        return "{$this->affichedetails()} , Nombre de pages : {$this->duree} pages";
    }



}
$dvd = new Dvd("inception","nolan", 148);

echo $dvd->afficherInfos() . "<br>";




