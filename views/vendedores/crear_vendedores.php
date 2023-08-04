<main class="contenedor seccion">

    <h1>Registrar Vendedor(a)</h1>
    <a href="/public/admin" class="boton boton-verde">Volver</a>

    <!----Si hay errores lo recorremos y mostramoa alerta antes del formulario--->
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php endforeach; ?>

    <form class="formulario" method="POST"  enctype="multipart/form-data">
        <?php include 'formulario_vendedores.php'; //incluimos el fomulario
        ?>
        <input type="submit" value="Registrar Vendedor(a)" class="boton boton-verde">
    </form>

</main>