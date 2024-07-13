<?php

    namespace App\Vendas;

    class Compra{

        public $id, $produtos, $usuario;

        public function cadastrar(array $produtos, Usuario $usuario){
            $this->id = rand(0, 1000);
            $this->produtos = $produtos;
            $this->usuario = $usuario;
        }

        public function imprimir(){            
            $impressao = 'Compra id : ' . $this->id . '<hr>';
            $impressao .= 'Produtos: ' . '<br>';

            foreach($this->produtos as $produto){
                $impressao .= $produto->imprimir();                
            }

            $impressao .= '<hr>';
            $impressao .= $this->usuario->imprimir();
            
            return $impressao;
            
            // echo('<pre>');
            // print_r($this->produtos);
            // echo('</pre>');
        }
    }