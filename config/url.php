<?php

$paginaAtual  = isset( $_GET['p'] ) && trim( $_GET['p'] ) != '' ? trim( $_GET['p'] ) : '';
$subPagina    = isset( $_GET['sp'] ) && trim( $_GET['sp'] ) != '' ? trim( $_GET['sp'] ) : '';
$subPagina2   = isset( $_GET['sp2'] ) && trim( $_GET['sp2'] ) != '' ? trim( $_GET['sp2'] ) : '';
$numeroPagina = isset( $_GET['pg'] ) && trim( $_GET['pg'] ) != '' ? trim( $_GET['pg'] ) : '';
$erro         = false;

if(($paginaAtual=='' || $paginaAtual=='home' || $paginaAtual=='estoque') && file_exists('estoque.php')){
    $incluir = 'estoque.php';
}elseif($paginaAtual=='departamentos'){
    $incluir = 'departamento.php';
}elseif($paginaAtual=='categorias'){
    $incluir = 'categoria.php';
}elseif($paginaAtual=='produtos'){
    $incluir = 'produto.php';
}else{
    $erro = true;    
}
