<?php
	// require_once("Conexao_Queries.php");
	// $nConexao = new Conexao_Queries("127.0.0.1", "pedidos", "root", "");	
	// $produtos = $nConexao->buscaProdutos();
/*
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
		<div>
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
							echo("<tr =id=\"linha$key\">");
								echo("<td>$value[codigo]</td>");
								echo("<td>$value[nome]</td>");
								echo("<td>".number_format($value["preco"], 2, ",", ".")."</td>");
								echo("<td><a href=\"#\" onclick=\"EditarLinha('linha$key');\">Editar</a></td>");
								echo("<td><a href=\"#\" onclick=\"ExcluirLinha('linha$key');\">Excluir</a></td>");								
							echo("</tr>");
						}				
					?>
					<tr>
						<td colspan="5">
							<div class="novo-registro">
								<a href="javascript:NovoRegistro();">[Novo produto]</a>
							</div>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>
*/
?>


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
		<div align="center" id="container">
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

		<footer>
			<script>
				/*
				var container = document.getElementById('container');
				var table = document.createElement('table');
				var tbody = document.createElement('tbody');
					
				table.style.width = '50%';
				table.setAttribute('border', '10');
				
				for(var i = 0; i < 3; i++){
					var tr = document.createElement('tr');
					for(var j = 0; j < 2; j++){
						if(i == 2 && j == 1){
							break;
						}else{
							var td = document.createElement('td');
							td.appendChild(document.createTextNode('matheus'))
							i == 1 && j == 1 ? td.setAttribute('rowSpan', '2') : null;
							tr.appendChild(td);
						}
					}
					tbody.appendChild(tr);
				}
				table.appendChild(tbody);
				container.appendChild(table);
				*/
			</script>
		</footer>
	</body>
</html>