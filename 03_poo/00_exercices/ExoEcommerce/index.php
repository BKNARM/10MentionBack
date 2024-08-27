<?php

require_once "Product.php";
require_once "Order.php";


//importation des namespace
use ExoEcommerce\Product;
use ExoEcommerceBis\Order;


//Création des produits : instanciation de la classe Product


$produit1 = new ExoEcommerce\Product("laptop", 500);// je peux utiliser cette syntaxe si je ne veux pas mettre des 'use' dans mon fichier

$produit2 = new Product("Smartphone", 1000);//avec l'utilisation du mot clé use

//création de la commande : instanciation de la class 'Order'

$order = new Order(55);
// var_dump($order);
$order->addProduct($produit1);
$order->addProduct($produit2);


//Ajout des produits à la commande

//Affichage des informations de la commande

echo "id de la commande : ".$order->getOrderId()." <br>";

//Les produit dans la commande

// var_dump($order->getProduitList());

$toutLesProduit = $order->getProduitList(); 

foreach ($toutLesProduit as $value) {
    
    echo "Le produit : {$value->getName()}, coute : {$value->getPrice()} € <br>";
}