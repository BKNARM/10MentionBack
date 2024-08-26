<?php
class Pompe {


    /**
     * La taille du réservoire de la Pompe en litres
     *
     * @var integer
     */
    private int $tailleReservoirePompe;

    /**
     *Quantité d'essence actuellement dans le réservoire de la Pompe
     *
     * @var float
     */
    private float $nbLitresEssencePompe;


    /**
     * Constructeur de la classe Pompe
     *
     * @param integer $t
     * @param float $l
     */
    public function __construct(int $t, float $l) {

        $this->setTailleReservoirePompe($t);
        $this->setNbLitreEssencePompe($l) ;

    }


    /**
     *Définir la quantité d'essence dans le réservoire de la Pompe
     *
     * @param float $quantite
     * @return void
     */
    public function setNbLitreEssencePompe(float $quantite) :void{

        $this->nbLitresEssencePompe = $quantite;

    }

    /**
     * Définir la taille du réservoire de la Pompe
     *
     * @param int $quantite
     * @return void
     */
    public function setTailleReservoirePompe(int $taille) :void{

        $this->tailleReservoirePompe = $taille;

    }




    /**
     * Méthode pour récupérer la taille du réservoire de la Pompe
     *
     * @return integer
     */
    public function getTailleReservoirePompe() :int{

        return $this->tailleReservoirePompe;


    }


    /**
     * Méthode pour récupérer la quantité d'essence dans le réservoire de la Pompe
     *
     * @return float
     */
    public function getNbLitreEssencePompe() :float{

        return $this->nbLitresEssencePompe;

    }


    /**
     * Délivrer de l'essence à une voiture
     *
     * @param Voiture $v
     * @return string
     */
    public function delivrerEssence(Voiture $v){  // Inqique que la méthode attend un objet de type Voiture en paramètre.

        //Quantité à délivrer = taille du réservoire de la voiture - nombre de litres dans le réservoire de la voiture

        $quantite_a_delivrer = $v->getTailleReservoireVoiture() - $v->getNbLitreEssenceVoiture();

        //Si la quantité à délivrer est supérieur à ce que la pompe a, ajuste la quantité à ce qui reste

        if ($quantite_a_delivrer > $this->getNbLitreEssencePompe()) {
            
            $quantite_a_delivrer = $this->getNbLitreEssencePompe();
        }


        //1-Mettre à jour la quantité d'essence dans la voiture
        $v->setNbLitreEssenceVoiture($v->getNbLitreEssenceVoiture() + $quantite_a_delivrer);

        //2-Mettre à jour la quantité d'essence restante dans la pompe

        $this->setNbLitreEssencePompe($this->getNbLitreEssencePompe()- $quantite_a_delivrer);

        //Retourne un message indiquant la quantité d'essence délivrée

        return "<p> je viens de délivrer $quantite_a_delivrer litre(s) d'essence </p>";

    }






}