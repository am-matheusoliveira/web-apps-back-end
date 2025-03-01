<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>Web Interativa com Ajax e PHP</title>
		<link rel="stylesheet" type="text/css" href="estilos.css">
		<script language="javascript" src="bibliotecaAjax.js"></script>
		<script language="javascript" src="tabelaDados.js"></script>
	</head>
	<body>
		<div align="center">
			<div id="avisos"></div>
			<form id="formulario">
	  			<table id="minhaTabela">
	    			<tr class="cabecalho">
	      				<td colspan="5"><div align="center"><strong>CADASTRO DE PRODUTOS</strong></div></td>
	    			</tr>
	    			<tr class="cabecalho">
	      				<td><strong>Código     </strong></td>
	      				<td><strong>Nome       </strong></td>
	      				<td><strong>Preço (R$) </strong></td>
	      				<td><strong>Editar     </strong></td>
	      				<td><strong>Excluir    </strong></td>
	    			</tr>
					<?php
						include "conecta.php";
						$res = mysqli_query($con, "SELECT * FROM produtos");
						$total = mysqli_num_rows($res);
						for($i = 0; $i < $total; $i++){
							$dados   = mysqli_fetch_row($res);
							$codigo  = $dados[0];
							$nome    = $dados[1];
							$preco   = $dados[2];
							$preco   = number_format($preco, 2,",", ".");  // formata o preço
							$idLinha = "linha$i";

							echo "<tr id=\"$idLinha\">";
							echo "  <td>$codigo</td>";
							echo "  <td>$nome</td>";
							echo "  <td>$preco</td>";
							echo "  <td><a href=\"#\" onclick=\"EditarLinha('$idLinha');\">Editar</a></td>";
							echo "  <td><a href=\"#\" onclick=\"ExcluirLinha('$idLinha');\">Excluir</a></td>";
							echo "</tr>";
						}
					?>
	    			<tr>
	      				<td colspan="5"><div align="right"><a href="javascript:NovoRegistro();">[Novo produto]</a></div></td>
	    			</tr>
	  			</table>
	  		</form>
		</div>
	</body>
</html>