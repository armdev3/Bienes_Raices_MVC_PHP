<?php
require_once __DIR__ . '/../includes/app.php';

//importamos nuestras clases de rutas y controlodores

use Controllers\LoginController;

use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedorController;
use Controllers\PaginasController;


$router = new Router();

/******Parte privada donde solo acceden lo administradores************************** */

//debuguear(VendedorController::class);
//debuguear(PropiedadController::class);//identificamios  en que lcase se encuentra el metodo

//ruta:http://localhost:3000/public

//defninimos nuestras urls pasandole la ruta y el controlador asiciado y el metodo
$router->get('/admin', [PropiedadController::class, 'index']); //identificamios  en que lcase se encuentra el metodo, pasandole dentro de un array la clase que contiene el metodo y el nombre del

$router->get('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->post('/propiedades/crear', [PropiedadController::class, 'crear']); //tambien definimos una post en router para enviar los datos

$router->get('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedades/eliminar', [PropiedadController::class, 'eliminar']);

/*******parte de los vendedores*************** */
//enrtuamos la pagina hacia vendedores, indicando el  la ruta del fichero, el controlador y su metodo o funcion
$router->get('/vendedores/crear_vendedores', [VendedorController::class, 'crear']);
$router->post('/vendedores/crear_vendedores', [VendedorController::class, 'crear']);

$router->get('/vendedores/actualizar_vendedor', [VendedorController::class, 'actualizar']);
$router->post('/vendedores/actualizar_vendedor', [VendedorController::class, 'actualizar']);
$router->post('/vendedores/eliminar', [VendedorController::class, 'eliminar']);
/*****fin *Parte privada donde solo acceden lo administradores************************** */



/*******pagina que ve el visitiante public****************** */
$router->get('/', [PaginasController::class, 'index']); //creamos la ruta principal
$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/propiedades', [PaginasController::class, 'propiedades']);
$router->get('/propiedad', [PaginasController::class, 'propiedad']);
$router->get('/blog', [PaginasController::class, 'blog']);
$router->get('/entrada', [PaginasController::class, 'entrada']);
$router->get('/contacto', [PaginasController::class, 'contacto']);
$router->post('/contacto', [PaginasController::class, 'contacto']);

// Login y Autenticacion
$router->get('/login', [LoginController::class, 'login']); //mostrar el formualrio
$router->post('/login', [LoginController::class, 'login']); //enviar datos del formulario
$router->get('/logout', [LoginController::class, 'logout']); // para salirnos

//este metodo muestra error en caso de no encontrar la pagina
$router->comprobarRutas();
