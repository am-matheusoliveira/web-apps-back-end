<?php

    namespace App\Vendas;

    class Produto{
        
        public $id, $descricao;

        public function cadastrar($id, $descricao){
            $this->id = $id;
            $this->descricao = $descricao;
        }

        public function imprimir(){
            $impressao = 'Produto id: ' . $this->id . ' | ';
            $impressao .= 'Descrição: ' . $this->descricao . '<br>';

            return $impressao;
        }
    }