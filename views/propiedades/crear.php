<main class="contenedor seccion">
    <h1>Crear</h1>

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


        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        <form>



</main>