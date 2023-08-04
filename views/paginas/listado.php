<div class="contenedor-anuncios">
    <?php foreach ($propiedades as $propiedad) { ?>

        <div class="anuncio">
            <img loading="lazy" src="/public/imagenes/<?php echo $propiedad->imagen ?>" alt="anuncio"><!--cargamos directamente la imagen desde el navegador-->
            <div class="contenido-anuncio">
                <h3><?php echo $propiedad->titulo; ?></h3>
                <p class="anuncio-espacio"><?php echo $propiedad->descripcion; ?></p>
                <p class="precio"><?php echo $propiedad->precio; ?>€</p>

                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono" loading="lazy" src="/public/build/img/icono_wc.svg" alt="icono WC">
                        <p><?php echo $propiedad->wc; ?></p>
                    </li>

                    <li>
                        <img class="icono" loading="lazy" src="/public/build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                        <p><?php echo $propiedad->estacionamiento; ?></p>
                    </li>

                    <li>
                        <img class="icono" loading="lazy" src="/public/build/img/icono_dormitorio.svg" alt="icono dormitorio">
                        <p><?php echo $propiedad->habitaciones; ?></p>
                    </li>

                </ul>
                <a href="/public/propiedad?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Ver propiedad</a>

            </div><!--.contenido-anuncios-->
        </div><!--Anuncio-->
    <?php }; //cerramos el foreach enf foreach
    ?>
</div><!--contenedor de anuncios-->