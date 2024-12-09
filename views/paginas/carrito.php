<main class="contenedor seccion">
    <h1>Mi Carrito</h1>

    <!-- Mostrar Alertas -->
    <?php 
        if (!empty($mensaje)) {
            echo "<p class='alerta exito'>{$mensaje}</p>";
        }
    ?>

    <?php if (!empty($carrito)): ?>
        <div class="table-responsive">
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Título</th>
                        <th scope="col">Precio Unitario</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Total</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                        $totalGeneral = 0;
                        foreach ($carrito as $item): 
                            $subtotal = $item->cantidad * $item->libro_precio;
                            $totalGeneral += $subtotal;
                    ?>
                        <tr>
                            <td><?php echo s($item->id_libro); ?></td>
                            <td><?php echo s($item->libro_titulo); ?></td>
                            <td class="precio-unitario">$<?php echo number_format($item->libro_precio, 2); ?></td>
                            <td>
                                <form method="POST" action="/bookspot/public/index.php/carrito/actualizar">
                                    <input type="hidden" name="id" value="<?php echo s($item->id); ?>">
                                    <input 
                                        type="number" 
                                        name="cantidad" 
                                        min="1" 
                                        value="<?php echo s($item->cantidad); ?>" 
                                        onchange="this.form.submit()"
                                    >
                                </form>
                            </td>
                            <td class="subtotal">$<?php echo number_format($subtotal, 2); ?></td>
                            <td>
                                <form method="POST" action="/bookspot/public/index.php/carrito/eliminar">
                                    <input type="hidden" name="id" value="<?php echo s($item->id); ?>">
                                    <input type="submit" class="boton-rojo" value="Eliminar">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Total General</th>
                        <th colspan="2" id="total-general">$<?php echo number_format($totalGeneral, 2); ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Botón para vaciar el carrito -->
        <form method="POST" action="carrito/vaciar">
            <input type="submit" class="boton-rojo" value="Vaciar Carrito">
        </form>
    <?php else: ?>
        <p>No tienes productos en tu carrito.</p>
    <?php endif; ?>
</main>