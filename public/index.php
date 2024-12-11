<?php
    require_once __DIR__ . "/../includes/app.php";

    use MVC\Router;
    use Controllers\LibroController;
    use Controllers\PaginasController;
    use Controllers\LoginController;
    use Controllers\UsuarioController;
    use Controllers\CarritoController;
    use Controllers\BuscarController;

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
    $router->get("/404", [PaginasController::class, "error"]);

    // Crear cuenta de Usuarios
    $router->get('/registrar', [UsuarioController::class, 'registrar']);
    $router->post('/registrar', [UsuarioController::class, 'registrar']);

    // Iniciar Sesión
    $router->get('/login', [UsuarioController::class, 'login']);
    $router->post('/login', [UsuarioController::class, 'login']);
    $router->get('/logout', [UsuarioController::class, 'logout']);
    
    // Recuperar Password
    $router->get('/olvide', [UsuarioController::class, 'olvide']);
    $router->post('/olvide', [UsuarioController::class, 'olvide']);
    $router->get('/recuperar', [UsuarioController::class, 'recuperar']);
    $router->post('/recuperar', [UsuarioController::class, 'recuperar']);

    // Confirmar cuenta
    $router->get("/confirmar-cuenta", [UsuarioController::class, 'confirmar']);
    $router->get("/mensaje", [UsuarioController::class, 'mensaje']);

    // Editar Usuario
    $router->get('/perfil', [UsuarioController::class, 'perfil']);
    $router->get('/configuracion', [UsuarioController::class, 'configuracion']);
    $router->post('/configuracion', [UsuarioController::class, 'configuracion']);
    $router->post('/eliminar-cuenta', [UsuarioController::class, 'eliminarCuenta']);


    // carrito
    $router->get('/carrito', [CarritoController::class, 'index']);
    $router->post('/carrito/agregar', [CarritoController::class, 'agregar']);
    $router->post('/carrito/eliminar', [CarritoController::class, 'eliminar']);
    $router->post('/carrito/vaciar', [CarritoController::class, 'vaciar']);
    $router->post('/carrito/actualizar', [CarritoController::class, 'actualizar']);
    $router->get('/carrito/contar', [CarritoController::class, 'contar']);


    // $router->get('/buscar', [BuscarController::class, 'buscar']);

    $router->post('/carrito/comprar', [CarritoController::class, 'comprar']);
    $router->get('/pedido', [CarritoController::class, 'detalle']);

    $router->comprobarRutas();