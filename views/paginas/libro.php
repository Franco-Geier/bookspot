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
        </section>
    </main>