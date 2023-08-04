<?php
//define son constanates en php
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'includes/funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/public/imagenes/');

//creamos una funcion para poder pasar el nombre com variable para reutilizar la funcion
function incluirTemplate(string $nombre, bool $inicio = false)
{
    // include "includes/templates/$nombre.php";
    include TEMPLATES_URL . "/$nombre.php"; //aqui se ve el ejemplo de define como utilizamos la variable constante
}


//Funcion para autenticar usuarios
function autenticacionUsuarios()
{
    session_start(); //invocamos la variable de session

    if (!$_SESSION['login']) { //si la variable de session no hay datos redirigimos a la pagina principal
        header('Location:/');
    }
}

function debuguear($var)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    exit;
}

//Escapar /sanitizar del html
function sanitizar($html): string
{
    $s = htmlspecialchars($html); // htmlspecialchars-->funcion de php para sanitizar los datos en el html
    return $s; //devolvemos los datos sanitizados

}

//Validar tipo de contenido

function validaTipoContenido($tipo)
{

    $tipos = ['vendedor', 'propiedad'];
    return in_array($tipo, $tipos); //busca el valor dentro de un array, toma dos valores, la variable  y el contenido a buscar

}

//Muestra los mensajes
function mostrarNotificacion($codigo)
{
    $mensaje = '';

    switch ($codigo) {
        case 1:
            $mensaje = 'Creado Correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }

    return $mensaje;
}




//Validar que sea un ID valido
function  validarORedireccionar(string $url)
{
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT); //lo que hacemos es reacsiganr la varible nuevamente  con un filtro para comprobar que solo admite enteros.

    if (!$id) { //si es distinto de un numero entero lo redirigimos a la pagina principal
        header("Location: $url");//camabiamos las comillas para que coja la variable de php
    }

    return $id;
}
