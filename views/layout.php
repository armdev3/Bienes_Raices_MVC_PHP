<?php
/***********MASTER PAGE**************************** */
if (!isset($_SESSION)) { //Si no esta vacia la session arrancamos la session
    session_start(); //para poder optner los datos  de la session, siempre tenemos aue invocar a session_start
}

$auth = $_SESSION['login'] ?? false; //si existe pasamos los dastos de la sesion  en la varibale, sino pasamos false
//var_dump($auth);//comrpueba la sesion devuelve false si el usuario no esta logado


if(!isset($inicio)){
    $inicio = false;

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/public/build/css/app.css"><!--Incluimos la hojas de estilos-->
</head>

<body>

<!---la variable $inicio recibira un valor cuando la funcion uncluir template haga referencia a esta plantilla, si la variable tiene un valor escribira mas abajo el header de inicio, en caso contrario no escribimos nada para que no se muestre nada-->
    <header class="header  <?php echo $inicio ? 'inicio' : '' ?>"><!-- comprieba la variable inicio-->
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/public"><!--indicamos que nos lleva a la pagina principal-->
                    <img src="/public/build/img/logo.svg" alt="logotipo de Bienes raices"><!--svg es mas ligero que webp-->
                </a>

                <!--Menu haburguesa-->
                <div class="mobile-menu">
                    <img src="/public/build/img/barras.svg" alt="icono menu responsive">
                </div>

                <!--boton de dark mode-->
                <div class="derecha">
                    <img class="dark-mode-boton" src="/public/build/img/dark-mode.svg">

                    <nav class="navegacion">
                            <a href="/public/nosotros">Nosotros</a>
                            <a href="/public/propiedades">Anuncios</a>
                            <a href="/public/blog">Blog</a>
                            <a href="/public/contacto">Contacto</a>

                        <?php if ($auth===true) { ?>
                          
                            <a href="/public/logout">Cerrar Sesión</a>
                        <?php }?>
    
                    </nav>
                </div><!-- fin boton de dark mode-->



            </div><!--Cierre de la barra-->

            <?php if ($inicio) { ?>
                <h1>Venta de Casas y Departamentos exclusivos de lujo</h1>
            <?php }; ?>

        </div>

    </header>


    <?php

    //vista donde mostrasmos los datos de toda la pagina defidas en la rutas
    echo $contenido;

    ?>
    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="nosotros.php">Nosotros</a>
                <a href="anuncios.php">Anuncios</a>
                <a href="blog.php">Blog</a>
                <a href="contacto.php">Contacto</a>
            </nav>
        </div>

        <p class="copyright">Todos los derechos Reservados <?php $fecha = date('Y'); echo $fecha; //imprimiemo el año actual?> &copy;</p>

    </footer>

    <script src="/public/build/js/bundle.min.js"></script>
    <!--incluimos el modernizer en el codigo para poder trabajar con imagenes webp-->
</body>

</html>