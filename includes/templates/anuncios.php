<?php
    use App\Libro;
    if (!isset($libros)) {
        $libros = isset($limite) ? App\Libro::librosConRelaciones($limite) : App\Libro::librosConRelaciones();
    }
?>

<div class="contenedor-anuncios">
    <?php if (!empty($libros)): ?>
        <?php foreach ($libros as $libro): ?>
            <div class="anuncio">
                <a href="anuncio.php?id=<?php echo $libro->id; ?>">
                    <img src="imagenes/<?php echo s($libro->imagen); ?>" alt="Imagen Libro">
                </a>
                <div class="contenido-anuncio">
                    <h3><?php echo s($libro->titulo) . " - " . s($libro->autor); ?></h3>
                    <p><small>Editorial: <?php echo s($libro->editorial); ?></small></p>
                    <p><small>Categoría: <?php echo s($libro->categoria); ?></small></p>
                    <p class="precio">$ <?php echo s($libro->precio); ?></p>
                    <a href="#" class="boton-naranja uppercase">Agregar al carrito</a>
                </div>
            </div>
        <?php endforeach; ?>
        <?php else: ?>
            <p>No hay libros disponibles en esta categoría.</p>
    <?php endif; ?>
</div> <!--.contenedor-anuncios-->