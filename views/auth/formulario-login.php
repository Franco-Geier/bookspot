        <div class="contenedor-alertas">
            <?php foreach($errores as $error): ?>
                <div class="alerta error">
                    <?php echo s($error); ?>
                </div>
            <?php endforeach; ?>
        </div>

        <form method="POST" class="formulario">
            <fieldset>
                <legend>Inicia Sesión Con Tus Datos</legend>            
                    <div class="campo">
                        <label for="email">E-mail</label>
                        <input type="email" placeholder="Tu Email" name="email" autocomplete="email" id="email">
                    </div>

                    <div class="campo">           
                        <label for="password">Password</label>
                        <input type="password" placeholder="Tu Password" name="password" autocomplete="current-password" id="password">
                    </div>
            </fieldset>
            <input type="submit" value="Iniciar Sesión" class="boton-verde">
        </form>