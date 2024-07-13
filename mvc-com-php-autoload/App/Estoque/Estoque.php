<?php

    namespace App\Estoque;

    class Estoque{
        private $total;

        public function __construct(){
            $this->total = rand(10, 1000);
        }

        public function getTotal(){
            return 'Total: ' . $this->total . '<br>';
        }
    }