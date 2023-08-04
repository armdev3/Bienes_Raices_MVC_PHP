<?php

namespace Model;

class ActiveRecord
{
    //base de datos
    //creamoa una propiedad protejida y estatica para poder acceder a ella solo desde la clase
    protected static $db; // protected no se puede acceder desde el obejto sino desde su clase y static porque siempre se va a realizar la misma conexion a la bases  dato y no hace falta estarla llamanado

    //creaamos los atributos estaticos 
    protected static $columnasDB = [];

    //creamos un atribuito que se utlizara como comodin desde propiedades y vendedores
    protected static $tabla = '';

    //validaciom de los datos que pasamos desde el formulario
    protected static $errores = []; //creamos una propiedad estatica en forma de array para validar los errores del formulario cuando recibamos los datos



    //hacemos uso de este metodo setDB en el fichero  de app.php desde ahi  se nos pasa la bases de datos  que utilizamo en este Active REcord
    public static function setDB($database)
    { //le psamos uina variable
        //hacemos referencia a la propieda o atributo estico
        //todo lo estatico hecemos  referencia con self ::, seftl es como el $this pero para variables  o propiedade estaicas
        self::$db = $database; //hece referncia  a las variable $db donde le psamos la conexion de la bases de datos del fichero app.php
    }


    public function guardar()
    {

        //Si el id es null no actualiza
        if (!is_null($this->id)) {

            $this->actualizar();
        } else {
            //sino estamo creando 
            $this->crear();
        }
    }

    //creamos un metodo para guardar los datos
    public function crear()
    {

        //sanitizar los datos
        $atributos = $this->sanitizarDatos();
        //debuguear(array_keys($atributos));
        //array_keys--funcion que devuelve la lcaves de un array
        //array_values-->devuelve lo valores de un array

        $cabeceras = join(',', array_keys($atributos)); //join->se utiliza para combinar los elementos de un arreglo en una sola cadena de texto.
        $valores = join("','", array_values($atributos)); //join->se utiliza para combinar los elementos de un arreglo en una sola cadena de texto.
        //debuguear($string);

        //Insertar en las bases de datos
        $query = "INSERT INTO " . static::$tabla . " ("; //hacemos referecias al atributo estatico que herendan otras clases
        $query .= $cabeceras;
        $query .= " ) VALUES ( '";
        $query .= $valores;
        $query .= " ')";
        //debuguear($query);

        $resultado = self::$db->query($query); //hacemos referencia a la propiedad  donde nos devolvera un resultado
        // debuguear($resultado);
        //mesaje de exito o error
        if ($resultado) {
            //Cuando los datos hayan sido validados e insertados, lo redirigeremos a la pagina principal 
            header('location:/public/admin?resultado=1');
        }
    }

    //Actualizar registro
    public function actualizar()
    {
        //sanitizar los datos
        $atributos = $this->sanitizarDatos();
        //debuguear('Actualizando...');

        $valores = []; //creamos un array para volcar lo datos en el

        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'"; //directamenta creamos un string con los valores y nos evitamos de escibir parte del update, ya que tendremos 
            //campo = valor


        }

        //debuguear(join(',',$valores));//La función join(',', $valores) recorre el array $valores y concatena cada elemento en una cadena, separando cada elemento con una coma.


        //Insertar en las bases de datos
        $actualizar = "UPDATE " . static::$tabla . " SET ";
        $actualizar .= join(',', $valores); //recorre el array $valores y concatena cada elemento en una cadena, separando cada elemento con una coma.
        $actualizar .= " WHERE id ='" . self::$db->escape_string($this->id) . "'"; //concatenamos el id sanitizado 
        $actualizar .= "LIMIT 1";

        //debuguear($actualizar);

        $resultado = self::$db->query($actualizar); //Actualizamos lo datos en la bases de datos

        //Cuando guardemos los datos redirigimos a la pagina principal
        if ($resultado) {
            header('location:/public/admin?resultado=2');
        }
    }

    //Eliminar Registro
    public function eliminar()
    {

        /******modoficacion mia**** actualizar antes de eliminar por problemas de foreing key********** */
               //Actualizamos los datos antes de realizar la elminiacion en la tabla de vendedores por la restrinccion de la clave foranea
               $actualizar = "UPDATE " . "propiedades" . " SET ";
               $actualizar .= "vendedores_id". " = " . "null" ;
               $actualizar .= " WHERE vendedores_id ='" . self::$db->escape_string($this->id) . "'"; //concatenamos el id sanitizado 
            
              //debuguear($actualizar);
               self::$db->query($actualizar);
              

        //debuguear('Eliminando...' . $this->id);
        //Eliminar una propiedad de la bases  de datos
        $delete_id = " DELETE FROM " . static::$tabla . " WHERE ID = " . self::$db->escape_string($this->id) . " LIMIT 1 "; //sanitizamos el id antes de eliminarlo , ya que es buena parctica sanitizar los datos del formulario

        //debuguear($delete_id);//comprobamos la consulta como nos queda
       
        $eliminado = self::$db->query($delete_id); //pasamo la consulta a la bases de datos para que se eleminie la información del id seleccionado
        //debuguear($eliminado);

        if ($eliminado) {//si los datos fueron eliminados borramos la imagendel servidor y redirigimos a la pagina principal
            $this->borrarImagen();
            header('location: /public/admin?resultado=3'); //redirigimos a esta misma pagina con resultado 3 para mostrar el mensaje de elimiando
        }

    }

    //este metodo carga o mapea el array atributos con el mismo nombre de la bases de datos
    public function atributos()
    {
        $atributos = [];

        foreach (static::$columnasDB as $columna) { //con estatic hacremos referencia al array  que heredan los hijos y sobre escriben en el para utilizar sus propias variables

            if ($columna === 'id') continue; //continue, cuando se encuentra con esa condicion inidicamos que pase al siguiente atributo, en resumen ignoramos el id

            $atributos[$columna] = $this->$columna; //cargamos el array de atributos con el nombre y valor de la columnas de los hijos;

        }

        return $atributos;//devolvemos el array cargado con los atributos de los hijos
    }

    //pasmos los datos que recibimos del mediente el llamado del metodo sanitizar
    //cargasmo los datos que recibimos y lo sanitizamos
    public function sanitizarDatos()
    {
        $atributos = $this->atributos(); // asu vez pasamo los datos  para cargar datos  con los mismos nombrey lo devolvemos buevamene al arrya de atributps

        //delaramos un array para poder sanitizarlo
        $sanitazado = [];


        //recorremo el array y cargamos los datos 
        foreach ($atributos as $key => $value) { //accedemos a la llave y valor
            $sanitazado[$key] = self::$db->escape_string($value); //hecemos la referencia a la base de datos con el self::$db y sanitizamos con escape_string
        }

        return $sanitazado;//devolvemos los datos sanitizados
    }


    //subida de archivos
    public function setImagen($nombre_imagen)
    {
        //desde actualizar se pasa la imagen que va a eliminar`;
        //Elimina la imagen previa si es en actualizar datos ¡, si es crear no hya nada que eliminar
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }
        //si no es actualizar y es cerar se Asigana al atributo de imangen el nombre de la imagen
        if ($nombre_imagen) {
            $this->imagen = $nombre_imagen; //nombre de la imagen que guardaremos en el la bases de datos

        }
    }


    //Eliminar Archivo
    public function borrarImagen()
    {

        //debuguear($this);//$this tiene toda la referencia del que se va a elimnar
        //comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        //debuguear($existeArchivo);devuelve true si el archivo existe
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }



    //obtener los errores
    public static function getErrores()
    {
        return static::$errores;
    }

    public function validar()
    {


        //Validacion de los datos
        static::$errores = []; //haceremos refrencia a la herencia donde se van a reescribir los errores
        return static::$errores;
    }


    //Lista todos los resgitros de las propiedades y vendedores 
    public static function all()
    {

        $query = "SELECT * FROM " . static::$tabla; //static va a buscar el atributo en las clases que la esten hereando y utilizando
        // debuguear($query);
        $resultado = self::consultarSQL($query);
        return $resultado;
    }


     //Obtener un determinado numero de resgitros en la pagina princiapal en la parte de casas y departamentos
     public static function get($cantidad)
     {
 
         $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad; //static va a buscar el atributo en las clases que la esten hereando y utilizando
         //debuguear($query);
         $resultado = self::consultarSQL($query);
         return $resultado;
     }


    //Busca un resgitro en BD por su id
    public static function find($id)
    {
        //Obtener los datos de la priopiedad
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id"; // con static::$tabla estamos haciando refrencia al atributo o propiedad que lo estan herendando
        // debuguear($query);
        $resultado = self::consultarSQL($query);



        return array_shift($resultado); //array_shift-- obtiene la primera posicion de un elemenro dentro de una array

    }

    //crea un array de objeto con con la consulta que le pasemos
    public static function consultarSQL($query)
    {

        //consultar la bases de datos
        $resultado = self::$db->query($query);
        //debuguear($resultado->fetch_assoc());
        //  debuguear($resultado);



        $array = [];
        //iterar los resultado de la bases de datos y llenar el array con objetos
        while ($registro = $resultado->fetch_assoc()) {
            //$array[]=$registro['titulo'];
            $array[] = static::crearObjeto($registro); // cons static hacemos refrencia a propiedades o varibles herededas por los hijos, pasamos el registro al metodo crerObjeto para combertitlo en objeto 


        }

        // debuguear($array);//devulve un array de objetos

        //liberar la memoria
        $resultado->free();

        //retornar los resultado
        return $array;
    }

    //convertimos un array en objeto
    protected static function crearObjeto($registro)
    {
        // $objeto = new self; // con new self iniciamos una instancia un objeto de clase propiedad, el cual tendra los mismos nombres de las propiedades y atributos.
        $objeto = new static; //ahora hacemos referencia  las nuevas clases que heredab 
        //recorremos el array para pasar lo datos de l array en el objeto
        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) { //property_exists, si existen esas claves 
                $objeto->$key = $value; //llenamo los dato
            }
        }

        //debuguear($objeto);
        return $objeto;
    }


    //sincroniza el objeto en memoria con los camabio realizados por el usuario
    public  function sincronizar($args = [])
    { //pasamos los datos nuevos como un array de argumnetos
        // debuguear($args);

        //los recorremos para mapearlos 
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) { //property_exists->va a comprobar que un atributo exista, $this tiene la refrencia actual del objeto y indicamos que no los argumento no esten vacios
                $this->$key = $value; //asigamos los nuevos valores en la referencia actual
            }
        }
    }
}
