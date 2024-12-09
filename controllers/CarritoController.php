<?php
    namespace Controllers;

    use Model\Carrito;
    use Model\Libro;
    use MVC\Router;

    class CarritoController {
        public static function index(Router $router) {
            session_start();
            $idUsuario = $_SESSION['usuario_id'] ?? null;

            if (!$idUsuario) {
                header('Location: /login');
                exit;
            }

            $carrito = Carrito::where('id_usuario', $idUsuario);
            $router->render('carrito/index', [
                'carrito' => $carrito
            ]);
        }


        public static function agregar(Router $router) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $carrito = new Carrito($_POST['carrito']);
                $errores = $carrito->validar();

                if (empty($errores)) {
                    $carrito->guardar();
                    header('Location: /carrito');
                }
            }
        }

        
        public static function eliminar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST['id'] ?? null;
                $id = filter_var($id, FILTER_VALIDATE_INT);

                if ($id) {
                    $carrito = Carrito::find($id);
                    $carrito->eliminar();
                }
            }
        }
    }