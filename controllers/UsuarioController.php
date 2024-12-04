<?php
    namespace Controllers;
    use Model\Usuario;
    use MVC\Router;

    class UsuarioController {
        public static function registrar(Router $router) {
            $usuario = new Usuario;
            $errores = Usuario::getErrores();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $usuario->sincronizar($_POST['usuario']);
                $errores = $usuario->validar();

                if (empty($errores)) {
                    $usuario->hashPassword();
                    $usuario->guardar();
                    header('Location: /login');
                }
            }

            $router->render('usuarios/registrar', [
                'usuario' => $usuario,
                'errores' => $errores
            ]);
        }

        public static function login(Router $router) {
            $errores = [];

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $auth = new Usuario($_POST['usuario']);
                $usuario = Usuario::findByEmail($auth->email);

                if ($usuario && password_verify($auth->password, $usuario->password)) {
                    session_start();
                    $_SESSION['usuario'] = $usuario->email;
                    $_SESSION['login'] = true;
                    header('Location: /');
                } else {
                    $errores[] = "Usuario o contraseña incorrectos.";
                }
            }

            $router->render('usuarios/login', [
                'errores' => $errores
            ]);
        }

        public static function logout() {
            session_start();
            $_SESSION = [];
            header('Location: /');
        }
    }