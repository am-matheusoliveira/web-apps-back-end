<?php
	require_once("Conexao_Queries.php");
	$nConexao = new Conexao_Queries("127.0.0.1", "pedidos", "root", "");
	$produtos = $nConexao->buscaProdutos();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="" content="text/html charset=ISO-8859-1">
		<title>Aprendendo PHP & AJAX Web-Iterativa</title>
		<link rel="stylesheet" type="text/css" href="estilos.css">
		<script language="javascript" src="bibliotecaAjax.js"></script>
		<script language="javascript" src="tabelaDados.js"></script>
	</head>
	<body>
		<div align="center" id="container">
			<div id="avisos"></div>
			<form id="formulario">
				<table id="minhaTabela">					
					<!-- TITULO DE NOSSA TABELA -->
					<tr class="cabecalho">
						<td colspan="5"> CADASTRO DE PRODUTOS</td>
					</tr>

					<!-- COLUNAS DE NOSSA TABELA -->
					<tr class="cabecalho">
						<td>Código</td>
						<td>Nome</td>
						<td>Preço (R$)</td>
						<td>Editar</td>
						<td>Excluir</td>						
					</tr>
					<!-- IMPRESSÃO DOS DADOS DE NOSSA TABELA -->
					<?php 
						foreach($produtos as $key => $value){															
							echo("<tr id=" . "linha$key" . ">");
								echo("<td>$value[codigo]</td>");
								echo("<td>$value[nome]</td>");
								echo("<td>".number_format($value["preco"], 2, ",", ".")."</td>");
								echo("<td><a href=" . "#" . " onclick=" . "EditarLinha('linha$key'); " . ">Editar</a></td>");
								echo("<td><a href=" . "#" . " onclick=" . "ExcluirLinha('linha$key');" . ">Excluir</a></td>");								
							echo("</tr>");
						}				
					?>
					<tr>
						<td colspan="5">
							<div align="right" class="novo-registro">
								<a href="javascript:NovoRegistro();">[Novo produto]</a>
							</div>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>