    <main class="contenedor seccion">
        <h1>Crear Cuenta</h1>
        <div class="contenedor-alertas">
            <?php foreach($errores as $error): ?>
                <div class="alerta error">
                    <?php echo s($error); ?>
                </div>
            <?php endforeach; ?>
        </div>


        <form method="POST" class="formulario">
            <fieldset>
                <legend>Llena el Formulario Para Crear una Cuenta</legend>               
                    <div class="formulario-nombres">
                        <div class="campo">
                            <label for="nombre">Nombre</label>
                            <input type="text" placeholder="Tu Nombre" value="<?php echo s($usuario->nombre); ?>" name="nombre" autocomplete="given-name" id="nombre">
                        </div>

                        <div class="campo">
                            <label for="apellido">Apellido</label>
                            <input type="text" placeholder="Tu Apellido" value="<?php echo s($usuario->apellido); ?>" name="apellido" autocomplete="family-name" id="apellido">
                        </div>
                    </div>

                    <div class="campo">
                        <label for="email">E-mail</label>
                        <input type="email" placeholder="Tu Email" value="<?php echo s($usuario->email); ?>" name="email" autocomplete="email" id="email">
                    </div>

                    <div class="campo">           
                        <label for="password">Password</label>
                        <input type="password" placeholder="Tu Password" name="password" autocomplete="current-password" id="password">
                    </div>
            </fieldset>
            <input type="submit" value="Crear Cuenta" class="boton-verde">
        </form>

        <div class="acciones contenedor-alertas">
            <a href="login">¿Ya tienes una cuenta? ¡Inicia sesión!</a>
            <a href="olvide">¿Olvidaste tu contraseña?</a>
        </div>
    </main>