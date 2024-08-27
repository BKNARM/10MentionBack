<?php




namespace ExoEcommerce {

    class Product
    {


        /**
         * Nom
         *
         * @var string
         */
        private string $name;



        /**
         * Prix 
         *
         * @var float
         */
        private float $price;


        /**
         * initialiser les propriétées
         *
         * @param string $n
         * @param float $p
         */
        public function __construct(string $n, float $p)
        {

            $this->name = $n;
            $this->price = $p;
        }


        /**
         * Get nom
         *
         * @return  string
         */
        public function getName() :string
        {
            return $this->name;
        }


        /**
         * Recuperer prix
         *
         * @return float
         */
        public function getPrice():float
        {

            return $this->price;
        }
    }
}
