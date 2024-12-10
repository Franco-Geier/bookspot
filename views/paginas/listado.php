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
                    
                    <!-- Botón para agregar al carrito -->
                    <form method="POST" action="/bookspot/public/index.php/carrito/agregar">
                        <input type="hidden" name="id_libro" value="<?php echo s($libro->id); ?>">
                        <?php if (!empty($_SESSION['id'])): ?>
                            <button 
                                type="button" 
                                class="boton-naranja uppercase add-to-cart" 
                                data-id="<?php echo s($libro->id); ?>">
                                <?php echo in_array($libro->id, $carritoLibros) ? "Quitar del carrito" : "Agregar al carrito"; ?>
                            </button>
                        <?php else: ?>
                            <a href="/bookspot/public/index.php/login" class="boton-naranja uppercase">Inicia sesión para comprar</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay libros disponibles.</p>
    <?php endif; ?>
</div>