    <h1>Contacto</h1>
    <picture>
        <source srcset="../../public/build/img/destacada.avif" type="image/avif">
        <source srcset="../../public/build/img/destacada.webp" type="image/webp">
        <source srcset="../../public/build/img/destacada.jpg" type="image/jpeg">
        <img src="../../public/build/img/destacada.jpg" alt="Imagen Contacto" loading="lazy">
    </picture>

    <main class="contenedor seccion">
        <h2>Llene el formulario de Contacto</h2>
        
        <div class="contenedor-alertas">
            <?php if ($mensaje): ?>
                <p class="alerta exito"><?php echo s($mensaje); ?></p>
            <?php endif; ?>

            <?php if (!empty($errores)): ?>
                <?php foreach ($errores as $key => $error): ?>
                    <p class="alerta error"><?php echo s($error); ?></p>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <form class="formulario" method="POST">
            <fieldset>
                <legend>Información Personal</legend>
                
                <div class="formulario-nombres">
                    <div class="campo">
                        <label for="nombre">Nombre</label>
                        <input type="text" placeholder="Tu nombre" name="contacto[nombre]" autocomplete="given-name" id="nombre" value="<?php echo s($respuestas->nombre); ?>" required>
                    </div>

                    <div class="campo">
                        <label for="apellido">Apellido</label>
                        <input type="text" placeholder="Tu apellido" name="contacto[apellido]" autocomplete="family-name" id="apellido" value="<?php echo s($respuestas->apellido); ?>" required>
                    </div>
                </div>

                <div class="campo">
                    <label for="mensaje">Mensaje:</label>
                    <textarea name="contacto[mensaje]" id="mensaje" required><?php echo s($respuestas->mensaje); ?></textarea>
                </div>
                
            </fieldset>

            <fieldset>
                <legend>Información de Contacto</legend>

                <p>¿Cómo Desea Ser Contactado?</p>
                <div class="mb-4 forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input type="radio" value="telefono" name="contacto[contacto]" id="contactar-telefono" required>
                    <label for="contactar-email">E-mail</label>
                    <input type="radio" value="email" name="contacto[contacto]" id="contactar-email" required>
                </div>

                <div id="contacto"></div>
            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>