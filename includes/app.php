<?php

//imoptamos Active record que es padre de todas las clases y donde fijaremos la conexion a la bases de datos

use Dotenv\Dotenv;//utilzamo la libreria para poder usar las variables de entorno
use Model\ActiveRecord;

//llamamos al fichero autolad para poder cargar nuestras clases de forma dianamica
require __DIR__ . '/../vendor/autoload.php';
/*******El archivo de app se va a covertir en el principal y con el autoload siempre cargara estos ficheros sin necesidad de estar utilizando require en todos las paginas******************************* */
/****Donde incluiremo todos los ficheros como funciones,bases de datos************************ */
require 'funciones.php';
require 'config/database.php';//fichero donde se encuentra la connfiguracion de la bases de datos

//El Dotenv se tiene que colocar de despues del autoload y la bases de datos
$dotenv = Dotenv::createImmutable(__DIR__);
//debuguear($dotenv);
$dotenv->safeLoad();//guardamos la configuracion


//conectarnos a la bases de datos creamos una variable con la conexion a la bases de datos
$db = conectarDB();


//llamamos al metodo de Active Recorspara pasarle la conexion de la bases de datos
ActiveRecord::setDB($db);