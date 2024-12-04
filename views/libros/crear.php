    <main class="contenedor seccion">
        <h1>Crear</h1>
        <a href="../admin" class="boton boton-verde">Volver</a>

                <!-- Alertas -->
        <div class="contenedor-alertas">
            <?php foreach($errores as $error): ?>
                <div class="alerta error">
                    <?php echo s($error); ?>
                </div>
            <?php endforeach; ?>
        </div>

        <form class="formulario mt-3" method="POST" enctype="multipart/form-data">
            <?php include __DIR__ . "/formulario.php"; ?>
            <input type="submit" value="Crear Libro" class="boton-verde">
        </form>
    </main>