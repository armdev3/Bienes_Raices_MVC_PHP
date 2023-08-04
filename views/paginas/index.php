<main class="contenedor seccion">
    <h1>Más Sobre Nosotros</h1>
    <?php include 'iconos.php';?>

</main>

<!--CONTENEDOR DE LAS IMAGENES DE LAS VIVIENDAS-->
<section class="seccion contenedor">
    <h2>Casas y Departamentos en Venta</h2>
    <?php

    include 'listado.php';
    ?>

    <div class="alinear-derecha">
        <a href="/public/propiedades" class="boton-verde">Ver Todas</a>
    </div>

</section>

<section class="imagen-contacto">
    <h2>Encuentra la casa de tus sueños</h2>
    <p>LLena el formulario de contacto y un asesor se pondrá en contacto contigo en la mayor brevedad</p>
    <a href="contacto.html" class="boton-amarillo">Contactános</a>

</section>

<div class="contenedor seccion seccion-inferior">
    <section class="blog">

        <h3>Nuestro Blog</h3>

        <!--Articulo1-->
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="/public/build/img/blog2.webp" type="image/webp">
                    <source srcset="/public/build/img/blog2.jpg" type="image/jpeg">
                    <img loading="lazy" src="/public/build/img/blog2.jpg" alt="Texto Entrada Blog"><!--con loading=lazy" indicamos al navegador que cuando llegue hasta aquí descargue la imagen del servidor-->
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="entrada.html">
                    <h4>Guía para la decoracion de tu hogar</h4>
                    <p class="informacion-meta">Escrito el <span> 08/06/2023 </span>por: <span> Admin</span></p>
                    <p>Maximiza el espacio en tu hogar con esta guía, aprende a combinar muebles y colores para darle vida a tu espacio</p>
                </a>

            </div>
        </article>

        <!--Articulo2-->
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="/public/build/img/blog1.webp" type="image/webp">
                    <source srcset="/public/build/img/blog1.jpg" type="image/jpeg">
                    <img loading="lazy" src="/public/build/img/blog1.jpg" alt="Texto Entrada Blog"><!--con loading=lazy" indicamos al navegador que cuando llegue hasta aquí descargue la imagen del servidor-->
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="entrada.html">
                    <h4>Terraza en tejado</h4>
                    <p class="informacion-meta">Escrito el <span> 08/06/2023 </span> por: <span> Admin</span></p>

                    <p>Consejos para contruir la terraza en el tejado , con los mejores materiales ahorrando dinero</p>
                </a>

            </div>
        </article>
    </section>

    <section class="testimoniales">
        <h3>Testimoniales</h3>

        <div class="testimonial">
            <blockquote>
                El personal se comporto de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas.
            </blockquote>
            <p>-Armando M.</p>

        </div>

    </section>
</div>