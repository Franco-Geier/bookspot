    <main class="contenedor seccion">
        <h1>Recuperar Password</h1>

        <div class="contenedor-alertas">
            <?php foreach ($errores as $error): ?>
                <div class="alerta <?php echo s($error['tipo']); ?>">
                    <?php echo s($error['mensaje']); ?>
                </div>
            <?php endforeach; ?>

        </div>
        <?php if(!$errorToken): ?>
            <form method="POST" class="formulario">
                <fieldset>
                    <legend>Coloca tu nuevo password a continuación</legend>
                    <div class="campo">           
                        <label for="password">Password</label>
                        <input type="password" placeholder="Tu nuevo Password" name="password" id="password">
                    </div>
                </fieldset>
                <input type="submit" value="Guardar Nuevo Password" class="boton-verde">
            </form>
        <?php endif; ?>

            <div class="acciones contenedor-alertas">
                <a href="login">¿Ya tienes una cuenta? ¡Inicia sesión!</a>
                <a href="registrar">¿Aún no tienes una cuenta? ¡Crear una!</a>      
            </div>
        
    </main>