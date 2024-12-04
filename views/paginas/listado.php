<div class="contenedor-anuncios">
    <?php if (!empty($libros)): ?>
        <?php foreach ($libros as $libro): ?>
            <div class="anuncio">
                <a href="/bookspot/public/index.php/libro?id=<?php echo $libro->id; ?>">
                    <img src="/bookspot/public/imagenes/<?php echo s($libro->imagen); ?>" alt="Imagen Libro">
                </a>
                <div class="contenido-anuncio">
                    <h3><?php echo s($libro->titulo) . " - " . s($libro->autor); ?></h3>
                    <p><strong>Editorial: </strong><small><?php echo s($libro->editorial); ?></small></p>
                    <p><strong>Categoria: </strong><small><?php echo s($libro->categoria); ?></small></p>
                    <p class="precio">$ <?php echo s($libro->precio); ?></p>
                    <a href="#" class="boton-naranja uppercase">Agregar al carrito</a>
                </div>
            </div>
        <?php endforeach; ?>
        <?php else: ?>
            <p>No hay libros disponibles.</p>
    <?php endif; ?>
</div> <!--.contenedor-anuncios-->