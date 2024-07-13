<?php
    
    spl_autoload_register(function($class_name){
        if(file_exists('Vendas/' . $class_name . '.php')){
            require_once('Vendas/' . $class_name . '.php');
        }
    });