document.addEventListener("DOMContentLoaded", function() {
    eventListener();
});


// Función para DarkMode
function darkMode() {
    const prefiereDarkMode = window.matchMedia("(prefers-color-scheme: dark)");
    const botonDarkMode = document.querySelector(".dark-mode-boton");

    if(prefiereDarkMode.matches) {
        document.body.classList.add("dark-mode");
    } else {
        document.body.classList.remove("dark-mode");
    }

    prefiereDarkMode.addEventListener("change", function(){
        if(prefiereDarkMode.matches) {
            document.body.classList.add("dark-mode");
        } else {
            document.body.classList.remove("dark-mode");
        }
    });

    if (botonDarkMode) {
        botonDarkMode.addEventListener("click", function() {
            document.body.classList.toggle("dark-mode");
        });
    }
}


// Función para navbar
function handleScroll() {
    const navbar = document.querySelector("nav.navbar.principal");

    if (navbar) {
        if (window.scrollY > 20) {
            navbar.classList.add("solid");
            navbar.classList.remove("transparent");
        } else {
            navbar.classList.add("transparent");
            navbar.classList.remove("solid");
        }
    }
}


// Función para contacto
function mostrarMetodosContacto(e) {
    const contactoDiv = document.querySelector("#contacto");

    if(e.target.value === "telefono") {
        contactoDiv.innerHTML = `         
            <div class="campo">           
                <label for="telefono">Número de Teléfono</label>
                <input type="tel" placeholder="Tu Teléfono" name="contacto[tel]" autocomplete="tel" id="telefono">
            </div>

            <p>Seleccione la Fecha y la Hora</p>
            <div class="formulario-nombres">
                <div class="campo">
                    <label for="fecha">Fecha:</label>
                    <input type="date" name="contacto[fecha]" id="fecha">
                </div>

                <div class="campo">
                    <label for="hora">Hora:</label>
                    <input type="time" name="contacto[hora]" id="hora" min="09:00" max="18:00">
                </div>
            </div>
        `;
    } else {
        contactoDiv.innerHTML = `
            <div class="campo">
                <label for="email">E-mail</label>
                <input type="email" placeholder="Tu Email" name="contacto[email]" autocomplete="email" id="email" required>
            </div>
        `;
    }
}


function eventListener() {
    darkMode();
    
    handleScroll();
    window.addEventListener("scroll", handleScroll);

    // Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"');
    metodoContacto.forEach(input => input.addEventListener("click", mostrarMetodosContacto));
}