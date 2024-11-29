<?php
    require "includes/app.php";
    $titulo = "BookSpot - Blog";
    $descripcion = "Mira nuestras nuestras entradas de blog.";
    use App\Categoria;
    $categorias = Categoria::all();
    incluirTemplate("header", false, $titulo, $descripcion, ['categorias' => $categorias]);
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Nuestro Blog</h1>

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

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog3.avif" type="/image/avif">
                    <source srcset="build/img/blog3.webp" type="/image/webp">
                    <source srcset="build/img/blog3.jpg" type="/image/jpeg">
                    <img src="build/img/blog3.jpg" alt="Texto Entrada Blog" loading="lazy">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Guía de compra de autos: Lo que necesitas saber antes de adquirir tu próximo vehículo</h4>
                    <p class="informacion-meta">Escrito el: <span>25/10/2024</span> por: <span>Admin</span></p>
                    <p>Comprar un auto es una inversión importante, y hay varios factores a considerar
                    antes de tomar la decisión final. En esta guía, te brindamos consejos clave sobre
                    qué aspectos tener en cuenta al comprar un auto nuevo o usado.</p>
                </a>
            </div>
        </article>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog4.avif" type="/image/avif">
                    <source srcset="build/img/blog4.webp" type="/image/webp">
                    <source srcset="build/img/blog4.jpg" type="/image/jpeg">
                    <img src="build/img/blog4.jpg" alt="Texto Entrada Blog" loading="lazy">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>El auge de los vehículos eléctricos: Lo que Tesla y otras marcas están preparando para el futuro</h4>
                    <p class="informacion-meta">Escrito el: <span>26/10/2024</span> por: <span>Admin</span></p>
                    <p>Los vehículos eléctricos están ganando terreno rápidamente, y marcas
                    como Tesla están liderando la revolución hacia un futuro más sostenible.</p>
                </a>
            </div>
        </article>
    </main>
    
<?php
    incluirTemplate("footer");
?>
