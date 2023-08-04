<?php 

namespace MVC;


class Router {
    public $rutasGET = [];
    public $rutasPOST = [];


    //creamos un metodo dende pasaremos  los parametros de las rutas y su metodo tanto para get como post
    public function get($url, $fn){//pasamos la ruta y su funcion o metodo
        $this->rutasGET[$url]=$fn;

    }

    public function post($url, $fn){
        $this->rutasPOST[$url]=$fn;

    }

    //creasmo un metodo para comprobar las rutas
   public function comprobarRutas(){
  
    session_start();

    //pasamos le valor de la session a la variable auth para comprobar si esta autenticado o no y pueda acceder al ponel de admin
    $auth = $_SESSION['login']?? null;


    //Array de ruta protegidas, iremo añadiendo la rutas que queremos proteger
    $rutas_protegidas =['/admin', '/propiedades/crear','/propiedades/actualizar','/propiedades/eliminar','/vendedores/crear','/vendedores/actualizar','/vendedores/eliminar'];


    //ruta:http://localhost:3000/public
    $url_Actual = $_SERVER['PATH_INFO'] ?? '/';//$_SERVER['PATH_INFO'] --> nos devuelve la ruta actual del navegador

    $metodo = $_SERVER['REQUEST_METHOD'];//obtenemo el tipo de metodo get o post

    //debuguear($url_Actual);


    //proteccion de la ruta de administrador
    //si el usuario accede a ruta protegida y no esta autenticado lo redirigimos a la pagina principal o de login
    if(in_array($url_Actual,$rutas_protegidas) && !$auth){//comprueba que el valor exista dentro del array, pasamos dos valores, la variable y el valor buscado
      header('Location: /public');

    }

    //Si el metodo es get enrutalas a get
    if($metodo==='GET'){
      //debuguear($this->rutasGET[$url_Actual]);
      //filtramos por la ruta actual para extraer su valor y si no existe la url lo ponemos a null
      $fn = $this->rutasGET[$url_Actual] ?? null;//$url_Actual--> busca dentro del array la ruta y se la pasa a la variable fn

    }else{
      //enruta a post
      $fn = $this->rutasPOST[$url_Actual] ?? null;

    }

    //comprovamos que la ruta tenga un valor
    if($fn){
        //mostramos la funcion asociada
      call_user_func($fn,$this);// call_user_func-> ayuda a identificar y ejecutar los metodos o funciones sin el nombre del metodo o funcion

    }else{
        
        echo "La Pagina no fue encontrada";

    }

   }//fin comprobar rutas

   //creamos un metodo que renderiza la vista y la muestra
   public function render($view, $datos = []){//recibe la ruta de la vista  y los datos en u array donde posteriormente construiremos un obejt
    //echo "Desde Render";
    //debuguear($datos);
    //debuguear($view);

    foreach($datos as $key=>$value){

      $$key = $value;//$$key -> es variable de variable , mantinen el nombre y no pierde el valor

    }

    //nota: aunque la variables del bucle foreach se hayan declarado antes ob_start, . Esto significa que cuando se llama a ob_start(), las propiedades del modelo ya se han asignado como variables. 

    ob_start();//inicia un almacenamiento en memoria la vista

    include __DIR__ . "/views/$view.php";//indicamos la ruta 

    //aqui se le asignan los datos de las variables del foreach que estan en memoria
    $contenido = ob_get_clean();//obtiene y limpia el contenido de  la memoria

    include __DIR__ . "/views/layout.php";//redirigimos la informacion a nuestra master page

   }//fin metodo render

}