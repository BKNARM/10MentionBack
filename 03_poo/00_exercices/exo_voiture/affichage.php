<?php

require_once "Voiture.php";
require_once "Pompe.php";


$voiture = new Voiture(50 , 5);

$pompe = new Pompe(800, 800);

//////////////////////////// Départ

//voiture

echo "<p> Le réservoire de la voiture : {$voiture->getTailleReservoireVoiture()}, il ya {$voiture->getNbLitreEssenceVoiture()} litres dans le réservoire</p>";


//pompe

echo "<p> La pompe contient {$pompe->getNbLitreEssencePompe()} litres, et sa contenance est de {$pompe->getTailleReservoirePompe()} </p>";

//On passe à la pompe

echo $pompe->delivrerEssence($voiture);

//Apres passage

//voiture

echo "<p> Le réservoire de la voiture : {$voiture->getTailleReservoireVoiture()}, il ya {$voiture->getNbLitreEssenceVoiture()} litres dans le réservoire</p>";

echo "<p> La pompe contient {$pompe->getNbLitreEssencePompe()} litres, et sa contenance est de {$pompe->getTailleReservoirePompe()} </p>";

