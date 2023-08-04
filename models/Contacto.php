<?php

namespace Model;


class Contacto extends ActiveRecord
{

    //heredamos $columnaDB de ActiveRedord y la reescribimos
    //protected static $columnasDB = ['nombre','apellido','telefono','tipo','presupuesto','contacto','fecha','hora'];


    //creamos los atributos de esta clase
    public $nombre;
    public $mensaje;
    public $telefono;
    public $email;
    public $tipo;
    public $presupuesto;
    public $contacto;
    public $fecha;
    public $hora;

    //cremos el constrcutor
    public function __construct($args = [])
    {

        $this->nombre = $args['nombre'] ?? '';
        $this->mensaje = $args['mensaje'] ?? '';
        $this->contacto = $args['contacto'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->tipo = $args['tipo'] ?? '';
        $this->presupuesto = $args['presupuesto'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
    }


    public function validar()
    {


        //Validacion de los datos
        if (!$this->nombre) {
            self::$errores[] = 'El nombre es obligatorio'; //la propiedad errores no hace falta declararla porque directamente la heredamos del ActiveRcord  para poder hacer uso de ella
        }

        if (!$this->mensaje) {
            self::$errores[] = 'El mensaje es Obligatorio';
        }

        
        if (!$this->tipo) {
            self::$errores[] = 'El tipo  es Obligatorio';
        }

        if (!$this->presupuesto) {
            self::$errores[] = 'El presupuesto  es Obligatorio';

        }

        //Comprobamos  el contacto
        if (!$this->contacto) {
            self::$errores[] = 'El Contacto es Obligatorio';
            return  self::$errores;
        }

        //comprobamo los datos del contacto
        if ($this->contacto === 'telefono') {

            if ($this->fecha === '') {
                self::$errores[] = 'El fecha  es Obligatorio';
            }
            if ($this->hora === '') {
                self::$errores[] = 'El hora  es Obligatorio';
            }

            if (!$this->telefono) {
                self::$errores[] = 'El Teléfono es obligatorio';
            }

            //preg_match funcion de php que se utliza para expreciones regulares,  //->tamaño fijo []->rango de numeros, {}-cantidad de numeros y pasamo el telefno para validarlo
            if (!preg_match('/[0-9]{9}/', $this->telefono)) {
                self::$errores[] = 'El Formato del telfono no es Válido';
            }

            return  self::$errores;

            //Comoprobamos los datos del Email
        } else if ($this->contacto === 'email') {


            if (!$this->email) {
                self::$errores[] = 'El email  es Obligatorio';
            }

            return  self::$errores;
        }
    } //fin metodo validar

}
