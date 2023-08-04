<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesion</h1>

    <?php foreach ($errores as $error) { ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php } ?>

    <form method="POST" class="formulario"  >
        <fieldset>
            <legend>Email y Password</legend>
            <!--email-->
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Tu email" id="email" />

            <!--Password-->
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Tu password" id="password" />
        </fieldset>

        <input type="submit" value="Iniciar Sesion" Class="boton boton-verde" />


    </form>

</main>