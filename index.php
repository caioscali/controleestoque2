<?php
function __autoload($class_name)
{
    require_once 'classes/' . $class_name . '.class.php';
}
require_once 'config/url.php';
?>
<!doctype html>
<html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <meta name="author" content="Caio Cezar Scali">
        <title>Controle de Estoque</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/dashboard.css" rel="stylesheet">
    </head>

    <body>
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Controle de Estoque</a>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <?php include_once("menu.php") ?>

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    <?php
                    if ($erro == true) {
                        echo ('<p align="center" class="erroTitulo">Erro 404 - Página não encontrada!</p>');
                        echo ('<br /><br />');
                        echo ('<p align="center" class="erroTexto">A página solicitada não foi encontrada,<br />certifique-se de ter digitado o endereço corretamente.</p>');
                    } else {
                        include_once($incluir);
                    }
                    ?>
                </main>
            </div>
        </div>
        <script src="js/jquery-3.4.1.slim.min.js"></script>
        <script src="js/bootstrap.bundle.min.js" ></script>
        <script src="js/feather.min.js"></script>
        <script src="js/dashboard.js"></script>
    </body>
</html>