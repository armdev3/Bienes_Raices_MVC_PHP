<?php

namespace Model;

/****creamos unas clase propiedad que luego la cargaremos con el autolad********************* */
class Propiedad extends ActiveRecord
{

    protected static $tabla = 'propiedades';
    //heredamos $columnaDB de ActiveRedord y la reescribimos, con los campos de nuesrtra tabla para ver la conexion
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_id'];

        //creamos los atributos de esta clase
        public $id;
        public $titulo;
        public $precio;
        public $imagen;
        public $descripcion;
        public $habitaciones;
        public $wc;
        public $estacionamiento;
        public $creado;
        public $vendedores_id;


        
    //cremos el constrcutor
    public function __construct($args = [])
    {
        $this->id = $args[''] ?? null; // ??->palceholder de php: si no hay datos lo ponemos com vacio
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $args['vendedores_id'] ?? '';
    }

    public function validar()
    {

        //resscribe la funciona con los datosa validar

        //Validacion de los datos
        if (!$this->titulo) {
            self::$errores[] = 'debes añadir un titulo';
        }


        if (!$this->precio or strlen($this->precio) > 10) {
            self::$errores[] = 'El precio es obligatorio o es demasiado largo, numero maximo 10 decimales';
        }

        if (strlen($this->descripcion) < 50) {
            self::$errores[] = 'La descripcion es obligatoria y al menos debe tener 50 caracteres';
        }

        if (!$this->habitaciones) {
            self::$errores[] = 'El numero de habitaciones es obligatorio';
        }

        if (!$this->wc) {
            self::$errores[] = 'El numero de baños es obligatorio';
        }

        if (!$this->estacionamiento) {
            self::$errores[] = 'El numero de plazas de parkin es obligatorio';
        }

        if (!$this->vendedores_id) {
            self::$errores[] = 'Introduce un vendedor';
        }

        if (!$this->imagen) {
            self::$errores[] = 'La imagen de la propiedad es Obligatoria';
        }

        return self::$errores;
    }
}
