<?php

namespace Controllers;

use MVC\Router; //importamos nuestra clase de router
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;
use Model\Contacto;

class PaginasController
{

    //creamos el metodo index de la pagina de la los visitantes

    public static function index(Router $router)
    {
        //echo "Desde index";

        $propiedades = Propiedad::get(3);

        $inicio = true;
        //pasamo la ruta donde se encuentra nuetra vista o pagina web
        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio


        ]); //pasasmo la variables que utilizaremos en la vista

    }

    //PAGINA NOSOTROS
    public static function nosotros(Router $router)
    {
        //echo "Desde nosotros";
        $router->render('paginas/nosotros');
    }



    public static function propiedades(Router $router)
    {
        //echo "Desde propiedades";

        //traemos los datos de la base de datos para posteriormente pasarlos a la vista
        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades

        ]);
    }
    public static function propiedad(Router $router)
    {
        //echo "Desde propiedad";
        //comprobamo que el id sea valido sino lo redireccionamos a la pagina de propiedades
        $id = validarORedireccionar('/public/propiedades');

        //si es valido realizamos lo busqueda de  los datos del id
        $propiedad = Propiedad::find($id);

        //si el id no se encuentra en la bases de dato lo reedirigimos
        if (!$propiedad) {
            header('Location: /public/propiedades');
        }

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad

        ]);
    }


    //Blog
    public static function blog(Router $router)
    {
        //echo "Desde blog";

        $router->render('paginas/blog');
    }

    public static function entrada(Router $router)
    {
        //echo "Desde entrada";

        $router->render('paginas/entrada');
    }



    //Formulario de la Vista de contacto
    public static function contacto(Router $router)
    {
        //echo "Desde contacto";

        //creamos un variable para mostrar el mensaje si los datos del formulario fueron enviados o no por correo
        $mensaje = null;



        //creamos  una instancio del array vacio de errores
        $errores = Contacto::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //debuguear($_POST['contacto']);


            //Creamos una instancia pasandole los datos del array del formulario, enviados del post
            $respuestas = new Contacto($_POST['contacto']);

            // debuguear($respuestas->nombre);

            //debuguear($datos_contacto);
            $errores = $respuestas->validar();

            //$respuestas = $_POST['contacto'];
           // debuguear($errores);

            if (!$errores) {
                //crear instancia de php Mailer para el envio de correos
                $email = new PHPMailer(); //automaticamente se importa la clase de automailer

                //Configurar SMPT
                $email->isSMTP(); //confirmamo que el tipo de envio es SMTP
                $email->Host = $_ENV['EMAIL_HOST']; // indicamos el servidor de correo
                $email->SMTPAuth = true; //inidcamos que vamos a Autenticarnos
                $email->Port = $_ENV['EMAIL_PORT']; //indicamos el puerto del envio del correo
                $email->Username = $_ENV['EMAIL_USER']; //usamos las credenciales de autenticacion
                $email->Password = $_ENV['EMAIL_PASS']; //usamos las credenciales de autenticacion


                //Configurar el envio del mail
                $email->SetFrom('admin@bienesraices.com'); //quien envia el correo
                $email->addAddress('admin@bienesraices.com', 'BienesRaices.com'); //quien lo recibe el correo
                $email->Subject = "Tienes un nuevo mensaje";

                //habilitamos HTML
                $email->isHTML(true);
                $email->CharSet = 'UTF-8'; //indicamos que soporta caracteres como  la ñ

                //debuguear($respuestas);

                //Definimos el contenido con html para mostrarlo en el buzon de mailtrap
                $contenido  = '<html>';
                $contenido .= '<p>Tienes un nuevo mensaje </p>';
                $contenido .= '<p>Nombre: ' . $respuestas->nombre . '</p>';


                //Enviar de forma condicional alguno campos de email o telefono
                //DE los radio buttoon comprobamos si telefono o emal para asigfnar lo valores
                if ($respuestas->contacto === 'telefono') {
                    $contenido .= '<p>Eligió ser contactado por Telefono:</p>';
                    $contenido .= '<p>Telefono: ' . $respuestas->telefono . '</p>';
                    $contenido .= '<p>Fecha Contacto: ' . $respuestas->fecha . '</p>';
                    $contenido .= '<p>Hora Contacto: ' . $respuestas->hora . '</p>';
                } else {
                    //Es Email, entonce agregamos el campo de email
                    $contenido .= '<p>Eligió ser contactado por Email:</p>';
                    $contenido .= '<p>Email: ' . $respuestas->email . '</p>';
                }


                $contenido .= '<p>Mensaje: ' . $respuestas->mensaje . '</p>';
                $contenido .= '<p>Vende o Compra: ' . $respuestas->tipo . '</p>';
                $contenido .= '<p>Presupuesto: ' . $respuestas->presupuesto . '€ </p>';
                $contenido .= '<p>Contacto: ' . $respuestas->contacto . '</p>';
                $contenido .= '</html>';

                $email->Body = $contenido;
                $email->AltBody = 'Esto es texto Alternativo sin HTML';

                //Enviar el Email
                if ($email->send()) { //Devuelve true o false si se envio el email

                    $mensaje = "Mensaje Enviado Correctamente";
                }
            }
        } //fin post


        //Enviamos los datos a la Vista
        $router->render('paginas/contacto', [
            'mensaje' => $mensaje,
            'errores' => $errores

        ]);
    }
}
