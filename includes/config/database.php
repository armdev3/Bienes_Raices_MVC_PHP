<?php

function conectarDB(): mysqli //devolvemos myqli
{
    //nota; como estamos realizando el codigo con clases, la conexion a bases de datos la enfocamos a programacion otirntada a objetos
    // $db = mysqli_connect('localhost', 'root', '1234', 'bieneraices_crud');//antigua conexion antes de active Record
    //$db = new mysqli('localhost', 'root', '1234', 'bieneraices_crud');
    $db = new mysqli(
        $_ENV['DB_HOST'],
        $_ENV['BD_USER'],
        $_ENV['DB_PASS'],
        $_ENV['DB_NAME']
    ); //pasamo los datos de la conexion a variables de entorno

    if (!$db) {
        echo "No se pudo conectar";
        exit;
    }

    return $db;
}
