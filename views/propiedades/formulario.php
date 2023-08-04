<fieldset>
    <legend>Información General</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo propiedad" value="<?php echo sanitizar($propiedad->titulo); ?>" />

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" maxlength="10" value="<?php echo sanitizar($propiedad->precio); ?>" />

    <label for="imagen">imagen:</label>
    <input type="file" id="imagen" accept="image/jpge, image/png" name="propiedad[imagen]" /><!--acept es solo para admitir loq que le indiquemos--->
    <?php if ($propiedad->imagen) { ?>
        <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small">
    <?php } ?>

    <label for="descripcion">Descripción</label>
    <textarea id="descripcion" name="propiedad[descripcion]"><?php echo sanitizar($propiedad->descripcion); ?></textarea>

</fieldset>


<!--parte dos del formulario-->
<fieldset>
    <legend>Información de la Propiedad</legend>
    <!---sanitizamos los datos del html que hemos definido en el fichero de funciones---->
    <label for="habitaciones">Habitaciones:</label>
    <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej:3" min="1" max="9" value="<?php echo sanitizar($propiedad->habitaciones); ?>" />

    <label for="wc">Baños:</label>
    <input type="number" id="wc" name="propiedad[wc]" placeholder="Ej:3" min="1" max="9" value="<?php echo sanitizar($propiedad->wc); ?>" />

    <label for="estacionamiento">Plazas de Parking:</label>
    <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ej:3" min="1" max="9" value="<?php echo sanitizar($propiedad->estacionamiento); ?>" />

</fieldset>

<!--ultima parte del formulario-->
<fieldset>
    <legend for="vendedor">Vendedor</legend>
    <select name="propiedad[vendedores_id]" id="vendedor">
        <option value="">--Seleccione Vendedor--</option>
        <?php foreach ($vendedores as $vendedor) { ?>
         <option 
                <?php if($propiedad->vendedores_id===$vendedor->id){echo 'selected';}else{ echo '';} ?>
                value="<?php  echo $vendedor->id?>"
          ><?php  echo $vendedor->nombre ." ". $vendedor->apellido?></option>
        
        

        <?php } //fin foreach 
        ?>

    </select>



</fieldset>