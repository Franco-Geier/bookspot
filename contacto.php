<?php
    require "includes/app.php";
    $titulo = "BookSpot - Contacto";
    $descripcion = "Contáctanos si tienes dudas";
    use App\Categoria;
    $categorias = Categoria::all();
    incluirTemplate("header", false, $titulo, $descripcion, ['categorias' => $categorias]);
?>

    <h1>Contacto</h1>
    <picture>
        <source srcset="build/img/destacada.avif" type="image/avif">
        <source srcset="build/img/destacada.webp" type="image/webp">
        <source srcset="build/img/destacada.jpg" type="image/jpeg">
        <img src="build/img/destacada.jpg" alt="Imagen Contacto" loading="lazy">
    </picture>

    <main class="contenedor seccion">
        <h2>Llene el formulario de Contacto</h2>

        <form action="#" class="formulario">

            <fieldset>
                <legend>Información Personal</legend>
                
                <div class="formulario-nombres">
                    <div class="campo">
                        <label for="nombre">Nombre</label>
                        <input type="text" placeholder="Tu nombre" name="nombre" autocomplete="given-name" id="nombre" required>
                    </div>

                    <div class="campo">
                        <label for="apellido">Apellido</label>
                        <input type="text" placeholder="Tu apellido" name="apellido" autocomplete="family-name" id="apellido" required>
                    </div>
                
                    <div class="campo">
                        <label for="email">E-mail</label>
                        <input type="email" placeholder="Tu Email" name="email" autocomplete="email" id="email">
                    </div>

                    <div class="campo">           
                        <label for="telefono">Telefono</label>
                        <input type="tel" placeholder="Tu Teléfono" name="tel" autocomplete="tel" id="telefono">
                    </div>
                </div>

                <div class="campo">
                    <label for="mensaje">Mensaje:</label>
                    <textarea name="mensaje" id="mensaje" required></textarea>
                </div>
                
            </fieldset>

            <fieldset>
                <legend>Información Sobre El Automóvil</legend>

                <div class="campo">
                    <label for="opciones">Vende o Compra</label>
                    <select name="opciones" id="opciones" required>
                        <option value="" disabled selected>-- Seleccione --</option>
                        <option value="compra">Compra</option>
                        <option value="vende">Vende</option>
                    </select>
                </div>

                <div class="campo">
                    <label for="presupuesto">Precio o Presupuesto</label>
                    <input type="number" placeholder="Tu Precio o Presupuesto" name="presupuesto" min="3000000" id="presupuesto" required>
                </div>
                
            </fieldset>

            <fieldset>
                <legend>Información de Contacto</legend>

                <p>¿Cómo Desea Ser Contactado?</p>
                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input type="radio" value="telefono" name="contacto" id="contactar-telefono">
                    <label for="contactar-email">E-mail</label>
                    <input type="radio" value="email" name="contacto" id="contactar-email">
                </div>

                <p>Seleccione la Fecha y la Hora</p>
                <div class="campo">
                    <label for="fecha">Fecha:</label>
                    <input type="date" name="fecha" id="fecha">
                </div>

                <div class="campo">
                    <label for="hora">Hora:</label>
                    <input type="time" name="hora" id="hora" min="09:00" max="18:00">
                </div>
            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>
    
<?php
    incluirTemplate("footer");
?>
