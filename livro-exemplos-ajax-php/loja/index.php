<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="js/estilos.css" type="text/css">
    <script type="text/javascript" src="js/bibliotecaAjax.js"></script>
    <script type="text/javascript" src="js/loja.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">    
    <title>Web Interativa com Ajax e PHP</title>
  </head>
  <body>
    <h2 align="center"><img src="figuras/loja.gif" width="278" height="80"></h2>
    <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr valign="top">
        <td colspan="3">
          <div align="right">
            <p>
              <span id="avisos"></span>
	            
              <img src="figuras/home.gif" width="16" height="16" align="absmiddle">
              <a href="javascript:Loja('inicio',0);">Home</a>

	            <img src="figuras/carrinho.gif" width="30" height="21" align="absmiddle">
              <a href="javascript:Loja('carrinho',0);">Meu carrinho</a>
            </p>
          </div>
        </td>
      </tr>
      <tr valign="top">
        <td width="150" class="fundocinza">
	        <p class="titulo">Categorias</p>
          <p>
            <?php include "php/mostraMenu.php"; ?>
          </p>
        </td>
        <td width="20"></td>
        <td width="630" class="fundolaranja">
	        <div id="conteudo"></div>
	      </td>
      </tr>
    </table>
    <p align="center" class="rodape">Copyright &copy; Loja Virtual Tabajara - Todos os direitos reservados.</p>
    <p align="center"></p>
  </body>
</html>
