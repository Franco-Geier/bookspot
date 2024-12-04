    <main class="contenedor seccion">
        <h1>Administrador de BookSpot</h1>

        <!-- Mostrar Alertas -->
        <?php 
            if($resultado) {
                $mensaje = mostrarNotificacion(intval($resultado));
                if($mensaje) { ?>
                    <p class="alerta exito"><?php echo s($mensaje); ?> </p>
                <?php }
            }
        ?>

        <a href="./libros/crear" class="boton boton-verde">Nuevo Libro</a>
    
        <h2>Libros</h2>
        <div class="table-responsive">
            <table class="table table-dark table-striped table-hover libros">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Título</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Editorial</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Creado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>

                <tbody class="table-group-divider"> <!-- Mostrar los Resultados -->
                    <?php if(count($libros) > 0): ?>
                        <?php foreach ($libros as $libro): ?>
                            <tr>
                                <td class="tabla-celda" scope="row" data-label="ID"><?php echo $libro->id; ?></td>
                                <td class="tabla-celda" scope="row" data-label="Título"><?php echo s($libro->titulo); ?></td>
                                <td class="tabla-celda" scope="row" data-label="Autor"><?php echo s($libro->autor); ?></td>
                                <td class="tabla-celda" scope="row" data-label="Descripción"><?php echo s($libro->descripcion); ?></td>
                                <td class="tabla-celda" scope="row" data-label="Precio">$ <?php echo s($libro->precio); ?></td>
                                <td class="tabla-celda" scope="row" data-label="Stock"><?php echo s($libro->stock); ?></td>
                                <td class="tabla-celda" scope="row" data-label="Categoría"><?php echo s($libro->categoria); ?></td>
                                <td class="tabla-celda" scope="row" data-label="Editorial"><?php echo s($libro->editorial); ?></td>
                                <td class="tabla-celda" scope="row" data-label="Imagen">
                                    <img src="../imagenes/<?php echo s($libro->imagen); ?>" alt="imagen libro" class="imagen-tabla">
                                </td>
                                <td class="tabla-celda" scope="row" data-label="Creado"><?php echo s($libro->creado); ?></td>
                                <td scope="row" data-label="Acciones">
                                    <form method="POST" action="./libros/eliminar">
                                        <input type="hidden" name="id" value="<?php echo $libro->id; ?>">
                                        <input type="submit" class="mt-3 boton-rojo" value="Eliminar">
                                    </form>
                                    <a href="./libros/actualizar?id=<?php echo $libro->id; ?>" class="boton-naranja">Actualizar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="11">No hay libros registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>