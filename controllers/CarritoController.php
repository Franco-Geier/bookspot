<?php
    namespace Controllers;

    use Model\Carrito;
    use Model\Libro;
    use Model\Categoria;
    use MVC\Router;

    class CarritoController {

        public static function index(Router $router) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $categorias = Categoria::all();

            $titulo = "BookSpot - Carrito";
            $descripcion = "Carrito de compras.";

            $idUsuario = $_SESSION['id'] ?? null;
        
            if (!$idUsuario) {
                header('Location: /bookspot/public/index.php/login');
                exit;
            }
        
            $carrito = Carrito::obtenerCarritoConLibros($idUsuario);
        
            $router->render('paginas/carrito', [
                'carrito' => $carrito,
                'mensaje' => $_SESSION['mensaje'] ?? null,
                "titulo" => $titulo,
                "categorias" => $categorias,
                "descripcion" => $descripcion
            ]);
            unset($_SESSION['mensaje']);
        }


        public static function agregar() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $idUsuario = $_SESSION['id'] ?? null;
        
            if (!$idUsuario) {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Usuario no autenticado']);
                exit;
            }
        
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = json_decode(file_get_contents('php://input'), true);
                $idLibro = filter_var($data['id_libro'], FILTER_VALIDATE_INT);
        
                if (!$idLibro) {
                    header('Content-Type: application/json');
                    echo json_encode(['error' => 'ID de libro inválido']);
                    exit;
                }
        
                // Verificar si el libro ya está en el carrito
                $carritoExistente = Carrito::consultarSQL("SELECT * FROM carrito WHERE id_usuario = $idUsuario AND id_libro = $idLibro");
        
                if ($carritoExistente) {
                    // Si existe, eliminarlo del carrito
                    $carritoExistente[0]->eliminar(false);
                    $status = 'removed';
                } else {
                    // Si no existe, agregarlo al carrito
                    $carrito = new Carrito([
                        'id_usuario' => $idUsuario,
                        'id_libro' => $idLibro,
                        'cantidad' => 1
                    ]);
                    $carrito->guardar(false);
                    $status = 'added';
                }
        
                // Responder con el estado actual del producto en el carrito
                header('Content-Type: application/json');
                echo json_encode(['status' => $status]);
                exit;
            }
        }


        public static function eliminar() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
        
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
                if ($id) {
                    $carrito = Carrito::find($id);
                    if ($carrito && $carrito->id_usuario === $_SESSION['id']) {
                        $carrito->eliminar(false);
                        $_SESSION['mensaje'] = "Producto eliminado correctamente.";
                    } else {
                        $_SESSION['mensaje'] = "No se pudo eliminar el producto.";
                    }
                }
                header('Location: /bookspot/public/index.php/carrito');
                exit;
            }
        }


        public static function vaciar() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $idUsuario = $_SESSION['id'] ?? null;

            if ($idUsuario) {
                $carrito = Carrito::whereAll('id_usuario', $idUsuario);
                foreach ($carrito as $item) {
                    $item->eliminar(false);
                }
            }
            header('Location: /bookspot/public/index.php/carrito');
            exit;
        }


        public static function actualizar() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
        
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
                $cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT);
        
                if ($id && $cantidad > 0) {
                    $carrito = Carrito::find($id);
                    if ($carrito && $carrito->id_usuario === $_SESSION['id']) {
                        $libro = Libro::find($carrito->id_libro);
                        if ($cantidad <= $libro->stock) {
                            $carrito->cantidad = $cantidad;
                            $carrito->guardar(false);
                            $_SESSION['mensaje'] = "Cantidad actualizada correctamente.";
                        } else {
                            $_SESSION['mensaje'] = "La cantidad no puede superar el stock disponible.";
                        }
                    }
                } else {
                    $_SESSION['mensaje'] = "Cantidad inválida.";
                }
            }
        
            header('Location: /bookspot/public/index.php/carrito');
            exit;
        }


        public static function toggle(Router $router) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
        
            $idUsuario = $_SESSION['id'] ?? null;
        
            if (!$idUsuario) {
                header('Location: /bookspot/public/index.php/login');
                exit;
            }
        
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $idLibro = filter_input(INPUT_POST, 'id_libro', FILTER_VALIDATE_INT);
        
                if (!$idLibro) {
                    header('Location: /bookspot/public/index.php/libros');
                    exit;
                }
        
                // Verificar si el libro ya está en el carrito
                $carritoExistente = Carrito::consultarSQL("SELECT * FROM carrito WHERE id_usuario = $idUsuario AND id_libro = $idLibro");
        
                if ($carritoExistente) {
                    // Si existe, lo quitamos
                    $carritoExistente[0]->eliminar();
                    $status = 'removed';
                } else {
                    // Si no existe, lo agregamos
                    $carrito = new Carrito([
                        'id_usuario' => $idUsuario,
                        'id_libro' => $idLibro,
                        'cantidad' => 1
                    ]);
                    $carrito->guardar();
                    $status = 'added';
                }
        
                // Devolver respuesta para el frontend
                header('Content-Type: application/json');
                echo json_encode(['status' => $status]);
                exit;
            }
        }


        public static function contar() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
        
            $idUsuario = $_SESSION['id'] ?? null;
        
            if ($idUsuario) {
                // Contar los productos únicos en el carrito
                $totalProductos = Carrito::whereAll('id_usuario', $idUsuario);
                $cantidad = count($totalProductos); // Cambiamos a count para productos únicos
                header('Content-Type: application/json');
                echo json_encode(['count' => $cantidad]);
            } else {
                echo json_encode(['count' => 0]);
            }
            exit;
        }
    } 