<?php
    require "includes/app.php";
    $titulo = "BookSpot - Nosotros";
    $descripcion = "Conoce más sobre BookSpot, la página web líder en venta de libros";
    incluirTemplate("header", $inicio = false, $titulo, $descripcion);
?>

    <main class="contenedor seccion">
        <h1>Conoce Sobre Nosotros</h1>
        
        <div class="contenido-nosotros">
            <div class="texto-nosotros">
                <blockquote>25 Años de Experiencia</blockquote>
                <p>Ed non ligula sit amet magna accumsan egestas euismod in nisl.
                Vestibulum tempus metus quam, ac rutrum metus elementum sit amet.
                Nam rhoncus eros et ipsum imperdiet rhoncus. Pellentesque nulla nulla,
                dictum dictum leo sit amet, elementum ornare erat. Aenean a sapien nunc.
                Mauris pellentesque fermentum orci, eu suscipit justo rhoncus sit amet.
                Maecenas a bibendum nisi, ac pharetra nisl. Quisque sed pellentesque sem.
                Cras odio quam, tempus ac magna vitae, porta aliquam sapien.</p>
    
                <p>Sed ullamcorper non augue vitae consequat. Sed fermentum interdum justo
                et aliquam. Donec feugiat porta orci sit amet facilisis. Curabitur
                pharetra sagittis felis sit amet hendrerit. Nunc cursus diam vitae
                faucibus rutrum. Duis tortor turpis, sagittis vitae luctus ac, eleifend
                nec massa. Morbi hendrerit consectetur dignissim. Integer iaculis ac nibh
                non finibus. Maecenas condimentum lectus et metus placerat viverra.</p>
            
                <a href="https://github.com/Franco-Geier" target="_blank" class="boton-verde">Saber Más</a>
            </div>
    
            <div class="imagen-nosotros">
                <picture>
                    <source srcset="build/img/nosotros.avif" type="image/avif">
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img src="build/img/nosotros.jpg" alt="Sobre Nosotros" loading="lazy">
                </picture>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
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
    </section>

<?php
    incluirTemplate("footer");
?>
