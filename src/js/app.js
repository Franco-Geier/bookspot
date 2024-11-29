document.addEventListener("DOMContentLoaded", function() {

    darkMode();

    handleScroll();
    window.addEventListener("scroll", handleScroll);
});

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