<?php

namespace Controllers;

//importamos router y nuestro modelo para poder trabajar con ellos desde el controlador
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

//creamos nuestra clase controller
class PropiedadController
{

    // creamos nuestro metodo
    //colocamos static por lo que no hace falta crear una instanciar desde donde la llamemos
    public static function index(Router $router)
    { //pasaremos la variable de $router como parametro para no perder la referencia, en resuman es pasar la variable que fue cargada en el index al controller
        //debuguear($router);

        $propiedades = Propiedad::all(); //hacemos la consulta a la bases de datos
        $vendedores = Vendedor::all();//consultamos los datos de los vendedores

        $resultado = $_GET['resultado'] ?? null; //colocamos le resultado a null antes de pasarselo a la vista



        //pasmos como parametros la ruta de la vista al metodo del router y las variables, en resumen pasamo los datos hacia la vista
        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores
        ]);
    }

    public static function crear(Router $router)
    { //colocamos static por lo que no hace falta crear una instanciar desde donde la llamemos
        //echo 'crear Propiedad';

        //creamos una propiedad vacia
        $propiedad = new Propiedad();

        //listamos de la base de datos los vendedores
        $vendedores = Vendedor::all();

        //Arrglo con mesajes de errores
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //nuestra en nuestra clase propiedad definimos un constructor como un arreglo
            //post es un arreglo de datos, por lo que podemos pasar directamente en la instancia de la clase $_post
            $propiedad = new Propiedad($_POST['propiedad']); //hemos añadifo en el formulario en la etiqueta name un array para obtener todos los datos del formulario.
            // debuguear($_POST['propiedad']);
            // debuguear($propiedad);

            /*******subida de Archivos************** */
            //creamos un carpeta
            $carpetaImagenes = '../../imagenes/'; //indicamos la rura de la carpeta de  imagenes;

            if (!is_dir($carpetaImagenes)) { //is_dir() es un funcion de php que nos sirve para comprobar si existe una carpeta
                mkdir($carpetaImagenes); //con la funcion mkdir creamos una carpeta
            }

            //generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg"; //con md5 nos da un identificador pero repetitivo, pero  con la funcion uniqid nos dara un identificador qeu ira cambiando, y le añadimos la funcion rand para que lo has mas aleatorea 

            //seteamos la imagen
            //Realiza un resize a la imagen con intervention
            //utilizamos image que es el alias de image intervention, pasamos la variable gloabl $_files que es donde se guardan las imagenes auq enviamos en el formualrio y la variable tmp_name que es donde se almacena en el servidor y esta tambien esta dentro del array de $_files

            ///debuguear($_FILES);

            if ($_FILES['propiedad']['tmp_name']['imagen']) { //si existe esa imagen seteamos
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600); //pasamos el efecto fit que recorta (crop)y (resize)ajusta el tamaño de la imagen ancho y alto
                $propiedad->setImagen($nombreImagen); //le pasamo el nombre de la imagen al metodo
            }

            //debuguear($_SERVER['DOCUMENT_ROOT']);


            //validamos los errores
            $errores = $propiedad->validar(); //devuelve los datos si se produjo algun error

            //Si no hay errores gurdamos los datos
            if (empty($errores)) {



                //crear la carpeta para subir la imagenes
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                //gudardamos la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen); //von save gurdamos la imagen, pero tambien podemos indicarle la ruta y el nombre de la imagen

                //Guarda en la bases de dato
                $propiedad->guardar();
            }
        }

        //pasamo la variables a la vista
        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores

        ]);
    }

    public static function actualizar(Router $router)
    { //colocamos static por lo que no hace falta crear una instanciar desde donde la llamemos

        //pasamo el valor del id valido
        $id = validarORedireccionar('/public/admin');

        //Realizamos la busqueda de los datos del id a actualizar
        $propiedad = Propiedad::find($id);

        //listamos de la base de datos los vendedores
        $vendedores = Vendedor::all();

        //Arrglo con mesajes de errores
        $errores = Propiedad::getErrores();

        

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            //Asignar lo atributos
            $args = $_POST['propiedad']; //psamos el post que recoge todos name que estan dentro de un array llamado propiedad que hemos  modificado en el formulario
            $propiedad->sincronizar($args); //pasamo los nuevos datos que hemos actualizado en el formulario, menos el dato de la imagen que se actualizar despues
        
            //debuguear($propiedad);
        
            //validacion
            $errores = $propiedad->validar();
            /**************Actualizacion de la imagen******************************/
            //generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
        
            if ($_FILES['propiedad']['tmp_name']['imagen']) { //si existe esa imagen seteamos
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600); //pasamos el efecto fit que recorta (crop)y (resize)ajusta el tamaño de la imagen ancho y alto
                $propiedad->setImagen($nombreImagen); //le pasamo el nombre de la imagen al metodo
            }
        
            if (empty($errores)) {
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    //Guarda la imagen en el servidor
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
        
        
                //guarda los datos actualizados
                $propiedad->guardar();
            }
        }

        //pasasmos la ruta y los datos donde se van a utilizar en la vista del formulario
        $router->render('/propiedades/actualizar',[
            'propiedad'=>$propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores

        ]);
       
    }


    //metodo de Eliminar los datos

    public static function Eliminar(){

        
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { //comprobamos que la variable id exista cuando se envia el formulario
            //  debuguear($_POST);
        
            //Validar Id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            //var_dump($id);
        
            if ($id) { //cundo confirmamos que es un entero
        
                $tipo = $_POST['tipo'];
                //debuguear($tipo);
        
                if (validaTipoContenido($tipo)) {

                    //buscamos los datos de la bases de datos
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }//fin Comprobacion del metodo POST

    }

    


}//fin de la clase

