<main class="contenedor seccion">
    <h1>Resultados para "<?php echo s($query); ?>"</h1>

    <?php
        if (empty($libros) && empty($categorias)) {
            echo "<p>No se encontraron resultados para tu búsqueda.</p>";
            exit;
        }
    ?>

    <section class="resultados-busqueda">
        <?php if (!empty($libros)): ?>
            <h2>Libros</h2>
            <div class="contenedor-anuncios">
                <?php foreach ($libros as $libro): ?>
                    <div class="anuncio">
                        <a href="/bookspot/public/index.php/libro?id=<?php echo $libro->id; ?>">
                            <img src="/bookspot/public/imagenes/<?php echo s($libro->imagen); ?>" alt="Imagen Libro">
                        </a>
                        <div class="contenido-anuncio">
                            <h3><?php echo s($libro->titulo); ?></h3>
                            <p>Autor: <?php echo s($libro->autor); ?></p>
                            <p>Editorial: <?php echo s($libro->editorial); ?></p>
                            <p class="precio">$<?php echo s($libro->precio); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No se encontraron libros.</p>
        <?php endif; ?>

        <?php if (!empty($categorias)): ?>
            <h2>Categorías</h2>
            <ul>
                <?php foreach ($categorias as $categoria): ?>
                    <li><a href="/bookspot/public/index.php/categorias?id=<?php echo $categoria->id; ?>"><?php echo s($categoria->nombre); ?></a></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No se encontraron categorías.</p>
        <?php endif; ?>
    </section>
</main>