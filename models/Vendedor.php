<?php

namespace Model;


class Vendedor extends ActiveRecord
{

    protected static $tabla = 'vendedores';
    //heredamos $columnaDB de ActiveRedord y la reescribimos
    protected static $columnasDB = ['id', 'nombre','apellido','telefono'];


     //creamos los atributos de esta clase
     public $id;
     public $nombre;
     public $apellido;
     public $telefono;

     
    //cremos el constrcutor
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null; // ??->palceholder de php: si no hay datos lo ponemos a null
        $this->nombre= $args['nombre'] ?? ''; 
        $this->apellido = $args['apellido'] ?? ''; 
        $this->telefono = $args['telefono'] ?? ''; 

    }


    public function validar()
    {


        //Validacion de los datos
        if (!$this->nombre) {
            self::$errores[] = 'El nombre es obligatorio';//la propiedad errores no hace falta declararla porque directamente la heredamos del ActiveRcord  para poder hacer uso de ella
        }
      
        if (!$this->apellido) {
            self::$errores[] = 'El Apellido es Obligatorio';
        }
        if (!$this->telefono) {
            self::$errores[] = 'El Teléfono es obligatorio';
        }

        //preg_match funcion de php que se utliza para expreciones regulares,  //->tamaño fijo []->rango de numeros, {}-cantidad de numeros y pasamo el telefno para validarlo
        if(!preg_match('/[0-9]{10}/', $this->telefono )){
            self::$errores[] = 'El Formato del telfono no es Válido';
        }
        
        return  self::$errores;

    }

}
