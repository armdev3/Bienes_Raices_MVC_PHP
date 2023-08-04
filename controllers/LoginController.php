<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;



class LoginController
{

    public static function login(Router $router)
    {

        $errores = []; //creamos un array vacio con lo errores

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //echo "Autenticando";
            //debuguear($_POST);

            //instaciamos un nuevo objeto con los datos que pasamos del formulario
            $auth = new Admin($_POST);
            $errores = $auth->validar(); //validamos los datos

            if (empty($errores)) {

                //Comprobar si el usuario existe con el metodo existe_usuario
                $resultado = $auth->existe_Usuario(); //obtenemod los resultados 
                 //debuguear($resultado);

                if (!$resultado) {
                    //Verificar si el usuario existe o no (mensaje de error)
                    $errores = Admin::getErrores(); //obtenemos los errores

                } else {
                    //Comprobar el password

                   $autenticado= $auth->comprobar_Password($resultado);

                   if($autenticado){
                    //Autenticar el usuario

                    $auth->autenticar();


                   }else{
                    $errores = Admin::getErrores(); //obtenemos los errores

                   }

                    

                }
            }
        }



        //echo "Desde login";
        $router->render('/auth/login', [
            'errores' => $errores
        ]);
    }


    //Cerrar la Session del usuario
    public static function logout()
    { 
        //echo "Desde logout";
        session_start();

        //Cerramos la session con un array vacio o tambien podemos usar sessio_destroy().
         $_SESSION =[];
        //debuguear($_SESSION);

        header('Location:/public');
    }
}
