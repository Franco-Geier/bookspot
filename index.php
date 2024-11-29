<?php
    require "includes/app.php";
    $titulo = "BookSpot - Inicio";
    $descripcion = "BookSpot es la mejor página web para comprar libros.";
    use App\Categoria;
    $categorias = Categoria::all();
    $limite = 3; // Muestra los últimos tres 
    incluirTemplate("header", true, $titulo, $descripcion, ['categorias' => $categorias]);
?>

    <main class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                Inventore delectus dolore mollitia fuga impedit aspernatur nulla in dicta!
                Possimus iure sed alias tempore eligendi pariatur at officia in</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                Inventore delectus dolore mollitia fuga impedit aspernatur nulla in dicta!
                Possimus iure sed alias tempore eligendi pariatur at officia in</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                Inventore delectus dolore mollitia fuga impedit aspernatur nulla in dicta!
                Possimus iure sed alias tempore eligendi pariatur at officia in</p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h2>Últimos libros en venta</h2>

        <?php
            include "includes/templates/anuncios.php";
        ?>

        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton-verde">Ver Todos</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <div class="contenedor contenido-contacto">
            <h2>Encuentra el auto de tus sueños</h2>
            <p>LLena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
            <a href="contacto.php" class="boton-naranja">Contáctanos</a>
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
                    <a href="entrada.php">
                        <h4>Guía para el mantenimiento básico de tu vehículo</h4>
                        <p class="informacion-meta">Escrito el: <span>23/10/2024</span> por: <span>Admin</span></p>
                        <p>Mantener tu vehículo en buen estado no solo garantiza una conducción segura, 
                        sino que también alarga la vida útil de tu auto y ahorra dinero a largo plazo.</p>
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
                    <a href="entrada.php">
                        <h4>Comparativas entre modelos: Encuentra el auto que mejor se adapta a ti</h4>
                        <p class="informacion-meta">Escrito el: <span>24/10/2024</span> por: <span>Admin</span></p>
                        <p>Elegir el auto ideal puede ser una tarea abrumadora con tantas opciones disponibles.
                        En esta comparativa, analizamos algunos de los modelos más populares del año.</p>
                    </a>
                </div>
            </article>
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>
                    El equipo fue increíble, me ayudaron a encontrar el auto perfecto. 
                    El proceso de compra fue rápido y sencillo, y el auto es justo lo que esperaba.
                </blockquote>
                <p>- Juan Pérez</p>
            </div>
        </section>
    </div>

<?php
    incluirTemplate("footer");
?>