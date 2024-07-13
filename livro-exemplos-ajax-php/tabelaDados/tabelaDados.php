<?php

	// HTTP -> https://developer.mozilla.org/pt-BR/docs/Web/HTTP/Headers/
	// EXPLICAÇÃO: https://www.youtube.com/watch?v=xchk_T0CUcs&ab_channel=ProfessorLarback

	$gmtDate = gmdate("D, d M Y H:i:s"); 
	header("Expires: {$gmtDate} GMT"); // data/hora da expiração desse cabeçalho
	header("Last-Modified: {$gmtDate} GMT"); // data/hora da modificação desse cabeçalho
	
	/**  
	 *	aqui temos duas diretivas, 
	 *  	no-cache = Força o cache a submeter a requisição ao servidor origem para validação antes de liberar a cópia em memória.	
	 * 		must-revalidate = O cache deve verificar o estado dos recursos caducos antes de usá-los e não usar recursos expirados.
	 * 
	 */
	header("Cache-Control: no-cache, must-revalidate"); 
	
	// Pragma: no-cache = 
	// O mesmo que Cache-Control: no-cache. 
	// Força os caches a mandarem uma requisição ao servidor de origem para validação antes de liberar a versão cacheada.
	header("Pragma: no-cache");


	header("Content-Type: text/html; charset=ISO-8859-1");
	// header("Content-Type: text/html; charset=UTF-8");

	include "conecta.php";	
	$acao  = isset($_GET["acao"]     ) ? $_GET["acao"]      : null;
	$nome  = isset($_GET["nome"]     ) ? mb_convert_encoding($_GET["nome"],'ISO-8859-1', 'UTF-8') : null;
	$preco = isset($_GET["preco"]    ) ? $_GET["preco"]     : null;
	$cod   = isset($_GET["cod"]      ) ? $_GET["cod"]       : null;

	// atualizar produto
	if($acao=="atualizar") {
		if(!empty($nome) && !empty($preco)) {
			// $preco = str_replace(",",".",$preco); // troca vírgula por ponto

			$preco = str_replace(',', '.', str_replace('.', '', $preco));
			if(is_numeric($preco)) {
				$res = mysqli_query($con, "UPDATE produtos SET nome='$nome', preco=$preco WHERE codigo=$cod");
				echo "atualizou";
			}else 
				echo "Preço inválido!";
		}else 
			echo "Você deve preencher todos os campos!";
	}

	// exclusão de produto
	elseif($acao=="excluir") { 
		$res = mysqli_query($con, "DELETE FROM produtos WHERE codigo=$cod");
		echo "excluiu";
	}

	// cadastro de produto
	elseif($acao=="cadastrar") { 
		if(!empty($nome) && !empty($preco)) {
			// $preco = str_replace(",",".",$preco); // troca várgula por ponto
			
			$preco = str_replace(',', '.', str_replace('.', '', $preco));			
			if(is_numeric($preco)) {
				$res = mysqli_query($con, "INSERT INTO produtos(nome,preco) VALUES ('$nome','$preco')");
				$novoCodigo = mysqli_insert_id($con);
				// retorna a palavra "cadastrou" seguida do código gerado para o produto
				echo "cadastrou-$novoCodigo";	
			}else 
				echo "Preçoo inválido!";
		}else
			echo "Você deve preencher todos os campos!";
	}
?>