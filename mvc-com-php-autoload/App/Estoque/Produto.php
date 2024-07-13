<?php

    namespace App\Estoque;

    class Produto{
        
        public $id, $descricao, $qtd;

        public function cadastrar($id, $descricao, $qtd){
            $this->id        = $id;
            $this->descricao = $descricao;
            $this->qtd       = $qtd;
        }

        public function imprimir(){
            $r = 'Produto id: ' . $this->id . ' | ';
            $r .= 'Descrição: ' . $this->descricao . ' | ';
            $r .= 'Quantidade: ' . $this->qtd . '<br>';

            return $r;
        }
    }