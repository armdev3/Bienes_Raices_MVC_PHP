<?php

namespace Controllers;


use MVC\Router; //importamos router 
use Model\Vendedor; //importamo el modelo donde se encuentran las bases de datos


//definimos niestra clases de vendedores
class VendedorController
{


    //Crear Vendedor
    public static function crear(Router $router)
    {

        $vendedor = new Vendedor; //instanciamos un nuevo vendedor vacio
        $errores = Vendedor::getErrores();  //Arrglo con mesajes de errores

        //cuando los datos se envia del formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //crear un nueva instancia
            $vendedor = new Vendedor($_POST['vendedor']); //lo reescribimos
            // debuguear($vendedor);

            //validar que no haya campos vacios
            $errores = $vendedor->validar();


            if (empty($errores)) {
                //si no hay errores guardamos los datos
                $vendedor->guardar();
            }
        } //fin post 

        $router->render('vendedores/crear_vendedores', [

            'errores' => $errores,
            'vendedor' => $vendedor

        ]);
    }


    //Actualizar Vendedor
    public static function actualizar(Router $router)
    {
        // echo "actualizar Vendedor";

        //Arrglo con mesajes de errores vacio para rescribirlo despues en el post
        $errores = Vendedor::getErrores();


        $id = validarORedireccionar('/public/admin'); //Si el id que recivimos no es valido lo redireccionamo a la pagina principal, si es valido asignamos valor en la variable

        //buscamos el id en la bases de datos
        $vendedor = Vendedor::find($id);

        //datos Actualizados del formulario lo enviamos por post
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //debuguear($_POST);//comprobamos los datos actualizados enviados desde el formulario
            //debuguear($vendedor);//datos que tenemos en la memoria recogidos de la bases de datos

            //Asigna los valores de post
            $args = $_POST['vendedor'];
            // debuguear( $args);

            //utilizamos el metodo sincronizar,(datos que tenemos gurdados en memoria de las consiltas en las bases de datos) le pasamos los nuevos datos del formulario 
            $vendedor->sincronizar($args);

            //Validamos los datos de errores
            $errores = $vendedor->validar();

            if (empty($errores)) {

                //debuguear($vendedor);
                $vendedor->guardar();
            }
        } //fin post 

        //pasamos los datos en la vista
        $router->render('vendedores/actualizar_vendedor', [
            'errores' => $errores,
            'vendedor' => $vendedor

        ]);
    }

    public static function eliminar()
    {
       //echo "Eliminar";

       if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       
        //debuguear($_POST);
      

        //validar el id
        $id = $_POST['id'];

        $id = filter_var($id, FILTER_VALIDATE_INT); //comprobamos que el id sea de tipo entero

        if($id){
             //valida el tipo a eliminar
             $tipo = $_POST['tipo'];
             if(validaTipoContenido($tipo)){
                $vendedor = Vendedor::find($id);//consultamos los datos por id en la bases de datos
                // debuguear($vendedor);
               $vendedor->eliminar();
                 //debuguear($eliminado);
             }

            

        }

       

       }
    }
}
