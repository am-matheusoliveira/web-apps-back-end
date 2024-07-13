<?php
    if(isset($_GET['parametro'])){
        
        $novoNumero = str_replace(",", ".", str_replace(".", "", $_GET['parametro']));
        echo(number_format($novoNumero, 2, ",", "."));
    }
?>
