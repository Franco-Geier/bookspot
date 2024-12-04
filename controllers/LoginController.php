<?php

    namespace Controllers;
    use MVC\Router;
    use Model\Categoria;
    use Model\Admin;

    class LoginController {
        public static function loginAdmin(Router $router) {
            $titulo = "Bookspot - Login-Admins";
            $descripcion = "inicia sesión como admin";
            $errores = [];
            $categorias = Categoria::all();

            if($_SERVER["REQUEST_METHOD"] === "POST") {
                $auth = new Admin($_POST);
                $errores = $auth->validar();

                if(empty($errores)) {
                    // Verificar si el usuario existe
                    $resultado = $auth->existeUsuario();

                    if(!$resultado) {
                        // Mensaje de error
                        $errores = Admin::getErrores();
                    } else {
                        // Verificar el password
                        $autenticado = $auth->comprobarPassword($resultado);
                        if($autenticado) {
                            // Autenticar al usuario
                            $auth->autenticar();
                        } else {
                            // Mensaje de error 
                            $errores = Admin::getErrores();
                        }   
                    }
                }
            }

            $router->render("auth/login-admin", [
                "titulo" => $titulo,
                "descripcion" => $descripcion,
                "errores" => $errores,
                "categorias" => $categorias
            ]);
        }

        public static function logoutAdmin() {
            session_start();
            $_SESSION = [];
            header("Location: ./");
        }
    }