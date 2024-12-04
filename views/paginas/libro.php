    <main class="contenedor seccion">
        <h1><?php echo s($libro->titulo) . " - " . s($libro->autor); ?></h1>

        <section class="anuncio-detalles">
            <div class="imagen-libro">
                <img src="/bookspot/public/imagenes/<?php echo s($libro->imagen); ?>" alt="Imagen Libro">
            </div>
    
            <div class="detalles-libro">
                <h2>Descripción</h2>
                <p><?php echo s($libro->descripcion); ?></p>
                
                <h2>Detalles</h2>
                <ul>
                    <li><strong>Título: </strong><?php echo s($libro->titulo); ?></li>
                    <li><strong>Autor: </strong><?php echo s($libro->autor); ?></li>
                    <li><strong>Editorial: </strong><?php echo s($libro->editorial); ?></li>
                    <li><strong>Categoría: </strong><?php echo s($libro->categoria); ?></li>
                    <p class="precio-libro">$ <?php echo s($libro->precio); ?></p>
                </ul>
    
                <button class="boton-naranja">Agregar al carrito</button>
            </div>
        </section>
    </main>