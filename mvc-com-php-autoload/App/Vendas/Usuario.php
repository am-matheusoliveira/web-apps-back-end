<?php

    namespace App\Vendas;

    class Usuario{
       
        public $nome, $idade;

        public function cadastrar($nome, $idade){
            $this->nome = $nome;
            $this->idade = $idade;
        }

        public function imprimir(){
            $impressao = 'Nome: ' . $this->nome . '<br>';
            $impressao .= 'Idade: ' . $this->idade . '<br>';

            return $impressao;
        }

    }