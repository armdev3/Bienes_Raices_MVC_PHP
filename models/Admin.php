<?php

namespace Model;

class Admin extends ActiveRecord
{
    //Bases de datos
    protected static $tabla = 'usuarios'; //proytected quiere decir que solo podemos acceder desde esta clase

    //heredamos $columnaDB de ActiveRedord y la reescribimos para daptarla a las columnas de nuestra tabla de la bases de datos
    protected static $columnasDB = ['id', 'email', 'password'];

    //creamos los atributos de esta clase
    public $id;
    public $email;
    public $password;



    //creamos el constrcutor
    public function __construct($args = [])
    {

        $this->id = $args['id'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }


    public function validar()
    {
        //Validacion de los datos
        if (!$this->email) {
            self::$errores[] = 'El Email es Obligatorio';
        }
        if (!$this->password) {
            self::$errores[] = 'El Password es obligatorio';
        }

        return  self::$errores;
    }

    public function existe_Usuario()
    {

        //REvisamos si el usuario existe  o no en la bases de datos

        $query = " SELECT * FROM " . self::$tabla . " WHERE email ='" . $this->email . "' LIMIT 1 "; //hacemos referencia a la tabla de esta misma clase a traves del self::

        $resultado = self::$db->query($query); //la pasamo la consulta a la bases de datos

        //debuguear($resultado);//num_rows nos devuelve un entero que indica el numero de filas devueltas de la consulta

        if (!$resultado->num_rows) { //si no hay resultados
            self::$errores[] = 'El Usuario no Existe'; //llenamos con el error de que el usuario no existe
            return; //finaliza el codigo parta no coin y almancena el error 

        }

        return $resultado; //Devuelve el resultado  de la consulta

    }


    public function comprobar_Password($resultado){

        $usuario = $resultado->fetch_object();

        //debuguear($usuario);//nos trae los datos que hemos obtenido en la bases de datos
        $autenticado = password_verify($this->password, $usuario->password);//password verify funcion de php para verfocar el password, toma dos parametros el primero lo que recibimos del formulario y el segundo lo que de la bases de datos hasehado, devulve un true o false

        if(!$autenticado){

            self::$errores[] = 'El password no es valido';
           
        }

        return $autenticado;

    }

    //Unma vez autenticado iniciamos una session con el usuario validado
    public function autenticar(){
        session_start();

        //llenar el array de session
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;
       
        header('Location: /public/admin');
        

    }
}
