    <main class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>
        <?php include "iconos.php"; ?>
    </main>

    <section class="contenedor seccion">
        <h2>Últimos libros en venta</h2>

        <?php
            include "listado.php";
        ?>

        <div class="alinear-derecha">
            <a href="/bookspot/public/index.php/libros" class="boton-verde">Ver Todos</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <div class="contenedor contenido-contacto">
            <h2>¿Tienes alguna consulta?</h2>
            <p>Si tienes preguntas sobre nuestros libros o servicios, llena el formulario y nos pondremos en contacto contigo.</p>
            <a href="/bookspot/public/index.php/contacto" class="boton-naranja">Contáctanos</a>
        </div>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.avif" type="/image/avif">
                        <source srcset="build/img/blog1.webp" type="/image/webp">
                        <source srcset="build/img/blog1.jpg" type="/image/jpeg">
                        <img src="build/img/blog1.jpg" alt="Texto Entrada Blog" loading="lazy">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="index.php/entrada">
                        <h4>Cómo conservar libros antiguos</h4>
                        <p class="informacion-meta">Escrito el: <span>23/10/2024</span> por: <span>Admin</span></p>
                        <p>Protege tus libros del polvo y la humedad.
                        Usa fundas de plástico y guárdalos en un lugar seco y ventilado.</p>
                    </a>
                </div>
            </article>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.avif" type="/image/avif">
                        <source srcset="build/img/blog2.webp" type="/image/webp">
                        <source srcset="build/img/blog2.jpg" type="/image/jpeg">
                        <img src="build/img/blog2.jpg" alt="Texto Entrada Blog" loading="lazy">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="index.php/entrada">
                        <h4>Mejores libros para leer este año</h4>
                        <p class="informacion-meta">Escrito el: <span>24/10/2024</span> por: <span>Admin</span></p>
                        <p>Descubre historias inolvidables y éxitos literarios que marcarán este año. 
                        ¡Haz crecer tu lista de lecturas!</p>
                    </a>
                </div>
            </article>
        </section>

        <!-- <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>
                    El equipo fue increíble, me ayudaron a encontrar el auto perfecto. 
                    El proceso de compra fue rápido y sencillo, y el auto es justo lo que esperaba.
                </blockquote>
                <p>- Juan Pérez</p>
            </div>
        </section> -->
    </div>