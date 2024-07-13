<?php
    // "classmap": ["Vendas", "Estoque"]
    // require_once('autoload.php');
        
    use App\Estoque\Estoque;
    use App\Estoque\Produto as estoque_produto;

    use App\Vendas\Compra;
    use App\Vendas\Produto as vedas_produto;
    use App\Vendas\Usuario;
    
    require_once('vendor/autoload.php');

    $usuario = new Usuario();
    $usuario->cadastrar('Matheus', 25);

    $produto_01 = new vedas_produto();
    $produto_01->cadastrar(10, 'Mouse');
    
    $produto_02 = new vedas_produto();
    $produto_02->cadastrar(20, 'Teclado');

    $compra = new Compra();
    $compra->cadastrar(
        array(
            'Produto_01' => $produto_01,
            'Produto_02' => $produto_02
        ),
        $usuario
    );

    echo($compra->imprimir());
    
    echo('<hr>');
    
    $e = new Estoque();
    echo($e->getTotal());

    
    $ep1 = new estoque_produto();
    $ep1->cadastrar(10, 'Mouse-Teclado', 10);

    
    $ep2 = new estoque_produto();
    $ep2->cadastrar(20, 'Mouse-Gamer', 20);

    echo('<hr>');
    echo($ep1->imprimir());
    echo($ep2->imprimir());



















