<?php

    require_once("Conexao_Queries.php");
    $nConexao = new Conexao_Queries("127.0.0.1", "pedidos", "root", "");

    // PREPARANDO OS VALORES VINDOS DO FORMULARIO
    $acao      = isset($_GET["acao"])  ? $_GET["acao"]  : null;
    $nome      = isset($_GET["nome"])  ? $_GET["nome"]  : null;
    $codigo    = isset($_GET["cod"])   ? $_GET["cod"]   : null;
    
    // TRATANDO O CAMPO PREÇO
    $preco     = isset($_GET["preco"]) ? $_GET["preco"] : null;
    $novoPreco = isset($_GET["preco"]) ? str_replace(',', '.', str_replace('.', '', $_GET["preco"])) : null;
    
    if($acao == "cadastrar"){
        // VERIFICA SE EXISTEM CAMPOS VAZIOS
        $campoVazio = validarCampos( array_pop($_GET) );

        if($campoVazio){

            if(is_numeric($novoPreco)){
                // AÇÃO DE INCLUIR NOVO REGISTRO
                $resposta = $nConexao->cadastrarProduto($nome, $preco);
                
                echo( json_decode( $resposta )->novoCodigo );

                // RETORNA UMA MENSAGEM DE RESPOSTA
                $myJson = new stdClass();
                $myJson->novoCodigo = json_decode($resposta)->novoCodigo;
                $myJson->preco      = $preco;
                $myJson->nome       = $nome;
                $myJson->msg        = json_decode($resposta)->msg;
                // 
                echo( json_encode( $myJson ) );
            }else{
                echo('{"preco": "Preço inválido!"}');
            }
        }else{
            echo('{"msg": "Você deve preencher todos os campos!"}');
        }

    }elseif($acao == "atualizar") {
        // VERIFICA SE EXISTEM CAMPOS VAZIOS
        $campoVazio = validarCampos($_GET);
        
        if($campoVazio){

            if(is_numeric($novoPreco)){
                // AÇÃO DE EDITAR REGISTRO
                $resposta = $nConexao->editarProduto($nome, $novoPreco, $codigo);

                // RETORNA UMA MENSAGEM DE RESPOSTA
                echo($resposta);
            }else{
                echo('{"preco": "Preço inválido!"}');
            }
        }else{
            echo('{"msg": "Você deve preencher todos os campos!"}');
        }
    }elseif($acao == "excluir") {
        
        // AÇÃO DE EXCLUIR REGISTRO
        $resposta = $nConexao->excluirProduto($codigo);

        // RETORNA UMA MENSAGEM DE RESPOSTA
        echo($resposta);
    }

    function validarCampos(){
        foreach($_GET as $nomeChave => $valorChave){

            if(empty($valorChave)){
                // echo("A variável $nomeChave esta vazia !!");
                return false;
            }
        }
        
        return true;
    }
?>  