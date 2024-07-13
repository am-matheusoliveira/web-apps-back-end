<?php
    
    Class Conexao_Queries{        
        
        // Variável que armazena a conexão
        private $pdo;

        // Nosso método construtor
        public function __construct($servername, $dbname, $username, $password){            
            try{
                $this->pdo = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8" ));

            }catch(PDOException $e){
                echo('PDO Erro de conexão: '.$e->getMessage());                
                exit();

            }catch(Exception $e){
                echo('Erros genericos: '.$e->getMessage());
                exit();                
            }
        }

        // Buscando nosso produtos no banco de dados
        public function buscaProdutos(){
            $resConsulta = array();
            $cmd = $this->pdo->query("SELECT * FROM produtos");
            $resConsulta = $cmd->fetchAll(PDO::FETCH_ASSOC);

            return $resConsulta;
        }
    }