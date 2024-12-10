<main class="contenedor seccion">
    <h1>Configuración</h1>

    <?php if (!empty($mensaje)): ?>
        <p class="alerta exito"><?php echo s($mensaje); ?></p>
    <?php endif; ?>

    <form method="POST" class="formulario">
        <div class="campo">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo s($usuario->nombre); ?>">
        </div>
        <div class="campo">
            <label for="apellido">Apellido</label>
            <input type="text" id="apellido" name="apellido" value="<?php echo s($usuario->apellido); ?>">
        </div>
        <div class="campo">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo s($usuario->email); ?>">
        </div>

        <input type="submit" class="boton-verde" value="Guardar Cambios">
    </form>

    <div class="acciones contenedor-alertas mt-4">
        <form method="POST" action="/bookspot/public/index.php/eliminar-cuenta" class="formulario alerta-eliminar">
            <fieldset>
                <legend>Eliminar Cuenta</legend>
                <p>Esta acción no se puede deshacer. Si eliminas tu cuenta, toda tu información será eliminada permanentemente.</p>
                <input type="submit" class="boton-rojo" value="Eliminar Cuenta">
            </fieldset>
        </form>
    </div>
</main>