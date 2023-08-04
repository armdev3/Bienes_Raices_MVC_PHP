<main class="contenedor seccion">
    <h1>Contacto</h1>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php endforeach; ?>

    
    <?php 
    
      if ($mensaje) { ?>
        <p id="mensaje" class='alerta exito'><?php echo $mensaje; ?></p>
        <script>
            //Codigo mio para limpiar el mensaje del formulario
           const limpiaMensaje = document.querySelector('#mensaje');
           setTimeout(()=>{
             limpiaMensaje.remove();

           }, 3000)
        </script>
        

    <?php }?>

   
        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpge">
            <img src="build/img/destacada3.jpg" alt="imagen contacto">
        </picture>

        <h2>Formulario de Contacto</h2>
        <form class="formulario" method="POST">
            <fieldset>
                <legend>Información Personal</legend>
                <!--nombre-->
                <label for="nombre">Nombre:</label>
                <input type="text" placeholder="Tu nombre" id="nombre" name="contacto[nombre]" />


                <!--Mensaje-->
                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="contacto[mensaje]"></textarea>
            </fieldset>

            <fieldset>
                <legend>Información de la propiedad</legend>
                <label for="opciones">Vende o Compra:</label>

                <select id="opciones" name="contacto[tipo]">
                    <option value="" disabled selected>--Seleccione</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>

                <!--presupuesto-->
                <label for="presupuesto">Precio o presupuesto:</label>
                <input type="number" placeholder="Tu Precio o presupuesto" id="presupuesto" name="contacto[presupuesto]" />

            </fieldset>

            <fieldset>
                <legend>Información de la propiedad</legend>
                <p>Como desea ser contactado</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Telefono</label>
                    <input type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" />

                    <label for="contactar-email">Email</label>
                    <input type="radio" value="email" id="contactar-email" name="contacto[contacto]" />
                </div>

                <div id="contacto">

                </div>


            </fieldset>
            <input type="submit" value="Enviar" class="boton-verde" />

        </form>



</main>