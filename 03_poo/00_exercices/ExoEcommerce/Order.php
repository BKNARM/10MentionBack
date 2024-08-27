<?php

namespace ExoEcommerceBis {

    use ExoEcommerce\Product;

    class Order
    {

        /**
         * L'identifiant de la commande
         * @var integer
         */
        private int $orderId;


         /**
         * Liste des produits dans la commande 
         *
         * @var array
         */
        private array $produitList = [];

        
        /**
         * Constructeur de la classe order
         *
         * @param integer $o
         */
        public function __construct(int $o)
        {
            
            $this->orderId = $o;
            // $this->produitList =$p;
            
        }
              
        
        public function getOrderId()
        {
        
           return $this->orderId;
        }
        
        public function getProduitList(){
        
           return  $this->produitList;
        }

        /**
         * Undocumented function
         *
         * @param $produit
         * @return void 
         */
        public function addProduct(Product $produit):void{
            
            $this->produitList[]= $produit;
            
        }
    }
}
