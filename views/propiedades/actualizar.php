<main class="contenedor seccion">

    <h1>Actualizar Propiedad</h1>

    <a href="/public/admin" class="boton boton-verde">Volver</a>


    <!----Si hay errores lo recorremos y mostramoa alerta antes del formulario--->
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">

        <?php
        //incluimos el formualrio dentro de nuestra pagina crear
        include __DIR__ . '/formulario.php'
        ?>


        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        <form>

</main>