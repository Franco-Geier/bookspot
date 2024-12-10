<main class="contenedor seccion">
    <h1>Detalle del Pedido</h1>

    <h2>Pedido ID: <?php echo $pedido->id; ?></h2>
    <p><strong>Fecha:</strong> <?php echo $pedido->fecha_pedido; ?></p>
    <p><strong>Total:</strong> $<?php echo number_format($pedido->total, 2); ?></p>
    <p><strong>Dirección de Envío:</strong> <?php echo $pedido->direccion_envio; ?></p>
    <p><strong>Teléfono de Contacto:</strong> <?php echo $pedido->telefono_contacto; ?></p>

    <h2>Productos</h2>
    <table class="table table-dark table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detalles as $detalle): ?>
                <tr>
                    <td><?php echo $detalle->id_libro; ?></td>
                    <td><?php echo s($detalle->titulo); ?></td>
                    <td><?php echo $detalle->cantidad; ?></td>
                    <td>$<?php echo number_format($detalle->precio_unitario, 2); ?></td>
                    <td>$<?php echo number_format($detalle->cantidad * $detalle->precio_unitario, 2); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>