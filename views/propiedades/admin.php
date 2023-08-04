
<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>

<?php

if($resultado){
    $mensaje = mostrarNotificacion(intval($resultado)); //el resultado lo convertimos a entero

    if ($mensaje) { ?>
        <p class="alerta exito"><?php echo sanitizar($mensaje) // sanitiozamos el mensaje ?></p> 
    <?php } 

}
    ?>

    <!-- botones para crear propiedades y vendedores  -->
    <a href="propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
    <a href="vendedores/crear_vendedores" class="boton boton-amarillo">Nuevo Vendedor</a>
    <h2>Propiedades</h2>

    <!-- propiedades -->
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody> <!--Mostrar los Registros que obtenemos de las bases de datos-->
            <tr>
                <?php foreach ($propiedades as $propiedad) : ?>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td><img src="../../public/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla"></td>
                    <td><?php echo $propiedad->precio; ?>€</td>
                    <td>
                        <form method="post" class="w-100" action="propiedades/eliminar"><!---enviamos a esta  misma pagina mensaje de eliminacion con post--->
                            <input type="hidden" name="id" value=<?php echo $propiedad->id; ?>><!---creamos un campo oculto con el id a eliminar---->
                            <input type="hidden" name="tipo" value="propiedad"><!---creamos un campo oculto con el tipo a eliminar---->
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <!---Enviamos mediante un enlace el id a actualizar-->
                        <a href="propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
            </tr>
        <?php endforeach; //fin de la iteracion con while
        ?>
        </tbody>
    </table>

    <!-- Vendedores -->
    <h2>Vendedores</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody> <!--Mostrar los Registros que obtenemos de las bases de datos-->
            <tr>
                <?php foreach ($vendedores as $vendedor) : ?>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <form method="post" class="w-100" action="vendedores/eliminar"><!---enviamos a esta  misma pagina mensaje de eliminacion con post--->
                            <input type="hidden" name="id" value=<?php echo $vendedor->id; ?>><!---creamos un campo oculto con el id a eliminar---->
                            <input type="hidden" name="tipo" value="vendedor"><!---creamos un campo oculto con el tipo a eliminar---->
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <!---Enviamos mediante un enlace el id a actualizar-->
                        <a href="vendedores/actualizar_vendedor?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
            </tr>
        <?php endforeach; //fin de la iteracion con while
        ?>
        </tbody>
    </table>

</main>