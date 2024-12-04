<?php
    require_once __DIR__ . "/../includes/app.php";

    use MVC\Router;
    use Controllers\LibroController;
    use Controllers\PaginasController;
    use Controllers\LoginController;

    $router = new Router();

    // Zona privado
    $router->get("/admin", [LibroController::class, "index"]);
    $router->get("/libros/crear", [LibroController::class, "crear"]);
    $router->post("/libros/crear", [LibroController::class, "crear"]);
    $router->get("/libros/actualizar", [LibroController::class, "actualizar"]);
    $router->post("/libros/actualizar", [LibroController::class, "actualizar"]);
    $router->post("/libros/eliminar", [LibroController::class, "eliminar"]);

    // Zona pública
    $router->get("/", [PaginasController::class, "index"]);
    $router->get("/nosotros", [PaginasController::class, "nosotros"]);
    $router->get("/libros", [PaginasController::class, "libros"]);
    $router->get("/libro", [PaginasController::class, "libro"]);
    $router->get("/categorias", [PaginasController::class, "categorias"]);
    $router->get("/blog", [PaginasController::class, "blog"]);
    $router->get("/entrada", [PaginasController::class, "entrada"]);
    $router->get("/contacto", [PaginasController::class, "contacto"]);
    $router->post("/contacto", [PaginasController::class, "contacto"]);


    // Login y autenticación
    $router->get("/login-admin", [LoginController::class, "loginAdmin"]);
    $router->post("/login-admin", [LoginController::class, "loginAdmin"]);
    $router->get("/logout-admin", [LoginController::class, "logoutAdmin"]);

    $router->comprobarRutas();