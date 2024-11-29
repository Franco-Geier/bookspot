<?php
    use App\Libro;
    $libros = isset($limite) ? Libro::librosConRelaciones($limite) : Libro::librosConRelaciones();
?>


<div class="contenedor-anuncios">
    <?php foreach($libros as $libro): ?>
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
            </div><!--.contenido-anuncio-->
        </div> <!--.anuncio-->
    <?php endforeach; ?>
</div> <!--.contenedor-anuncios-->