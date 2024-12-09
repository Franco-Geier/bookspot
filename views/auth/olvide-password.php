    <main class="contenedor seccion">
        <h1>Olvide Password</h1>

        <div class="contenedor-alertas">
            <?php foreach ($errores as $error): ?>
                <div class="alerta <?php echo s($error['tipo']); ?>">
                    <?php echo s($error['mensaje']); ?>
                </div>
            <?php endforeach; ?>
        </div>

        <form method="POST" class="formulario">
            <fieldset>
                <legend>Restablece Contraseña con tu Email</legend>            
                    <div class="campo">
                        <label for="email">E-mail</label>
                        <input type="email" placeholder="Tu Email" name="email" autocomplete="email" id="email">
                    </div>
            </fieldset>
            <input type="submit" value="Enviar Instrucciones" class="boton-verde">
        </form>
        
        <div class="acciones contenedor-alertas">
            <a href="login">¿Ya tienes una cuenta? ¡Inicia sesión!</a>
            <a href="registrar">¿Aún no tienes una cuenta? ¡Crear una!</a>      
        </div>
    </main>


   