<?php
//importamos la clase
use App\Propiedad;



// debuguear($propiedades);
//debuguear($_SERVER);//server nos devuelve toda la informacion  de nuestro servidor

if ($_SERVER["SCRIPT_NAME"] === "/anuncios.php") {

    //Traemos sus datos
    $propiedades = Propiedad::all();//listamos todas las propiedades
} else {
    $propiedades = Propiedad::get(3);//listasmo solo 3 propiedades


}

?>
<div class="contenedor-anuncios">
    <?php foreach ($propiedades as $propiedad) { ?>

        <div class="anuncio">
            <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen ?>" alt="anuncio"><!--cargamos directamente la imagen desde el navegador-->
            <div class="contenido-anuncio">
                <h3><?php echo $propiedad->titulo; ?></h3>
                <p class="anuncio-espacio"><?php echo $propiedad->descripcion; ?></p>
                <p class="precio"><?php echo $propiedad->precio; ?>€</p>

                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono WC">
                        <p><?php echo $propiedad->wc; ?></p>
                    </li>

                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                        <p><?php echo $propiedad->estacionamiento; ?></p>
                    </li>

                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                        <p><?php echo $propiedad->habitaciones; ?></p>
                    </li>

                </ul>
                <a href="/anuncio.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Ver propiedad</a>

            </div><!--.contenido-anuncios-->
        </div><!--Anuncio-->
    <?php }; //cerramos el foreach enf foreach
    ?>
</div><!--contenedor de anuncios-->