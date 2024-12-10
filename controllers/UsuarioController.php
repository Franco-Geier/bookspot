<?php

    namespace Controllers;
    use Model\Usuario;
    use Model\Categoria;
    use MVC\Router;
    use Classes\Email;

    class UsuarioController {

        public static function perfil(Router $router) {
            $titulo = "BookSpot - Mi Perfil";
            $descripcion = "Los datos de tu usuario";
            $categorias = Categoria::all();

            if (!isset($_SESSION)) {
                session_start();
            }
    
            $idUsuario = $_SESSION['id'] ?? null;
    
            if (!$idUsuario) {
                header('Location: /bookspot/public/index.php/login');
                exit;
            }
    
            $usuario = Usuario::find($idUsuario);
    
            $router->render('paginas/perfil', [
                'usuario' => $usuario,
                'titulo' => $titulo,
                "descripcion" => $descripcion,
                "categorias" => $categorias
            ]);
        }
    

        public static function configuracion(Router $router) {
            $titulo = "BookSpot - Configuración";
            $descripcion = "Cambia los datos de tu Perfil";
            $categorias = Categoria::all();

            if (!isset($_SESSION)) {
                session_start();
            }
    
            $idUsuario = $_SESSION['id'] ?? null;
    
            if (!$idUsuario) {
                header('Location: /bookspot/public/index.php/login');
                exit;
            }
    
            $usuario = Usuario::find($idUsuario);
            $mensaje = '';
    
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $usuario->sincronizar($_POST);
                $errores = $usuario->validar();
    
                if (empty($errores)) {
                    $usuario->guardar(false);
                    $mensaje = 'Perfil actualizado correctamente.';
                }
            }
    
            $router->render('paginas/configuracion', [
                'usuario' => $usuario,
                'mensaje' => $mensaje,
                'titulo' => $titulo,
                "descripcion" => $descripcion,
                "categorias" => $categorias
            ]);
        }



        public static function eliminarCuenta(Router $router) {
            if (!isset($_SESSION)) {
                session_start();
            }
    
            $idUsuario = $_SESSION['id'] ?? null;
    
            if (!$idUsuario) {
                header('Location: /bookspot/public/index.php/login');
                exit;
            }
    
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $usuario = Usuario::find($idUsuario);
                if ($usuario) {
                    $usuario->eliminar(false);
                    session_destroy();
                    header('Location: /bookspot/public/index.php');
                    exit;
                }
            }
        }


        public static function registrar(Router $router) {
            $titulo = "BookSpot - Registrarse";
            $descripcion = "Registrate para acceder a más contenido";
            $usuario = new Usuario;
            $categorias = Categoria::all();
            $errores = [];

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $usuario->sincronizar($_POST);
                $errores = $usuario->validar();

                if(empty($errores)) {
                    $resultado = $usuario->existeUsuario();

                    if($resultado->num_rows) {
                        $errores = Usuario::getErrores();
                    } else {
                        // Hashear el password
                        $usuario->hashPassword();
                        // Generar un Token único
                        $usuario->crearToken();
                        // Enviar el Email
                        $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                        $email->enviarConfirmacion();
                        // Crear el usuario
                        $resultado = $usuario->guardar(false);

                        if($resultado) {
                            header("Location: /bookspot/public/index.php/mensaje");
                            exit;
                        }
                    }
                }
            }
            $router->render('auth/registrar', [
                'usuario' => $usuario,
                'errores' => $errores,
                "titulo" => $titulo,
                "descripcion" => $descripcion,
                "categorias" => $categorias
            ]);
        }


        public static function mensaje(Router $router) {
            $titulo = "BookSpot - Mensaje";
            $descripcion = "Mensaje para revisar E-mail";
            $categorias = Categoria::all();

            $router->render("auth/mensaje", [
                "titulo" => $titulo,
                "descripcion" => $descripcion,
                "categorias" => $categorias
            ]);
        }


        public static function confirmar(Router $router) {
            $titulo = "BookSpot - Confirmar";
            $descripcion = "Confirmar cuenta de usuario";
            $errores = [];
            $token = s($_GET["token"]);
            $usuario = Usuario::where("token", $token);
            $categorias = Categoria::all();

            if(empty($usuario)) {
                $errores[] = ["tipo" => "error", "mensaje" => "Token no válido"];
            } else {
                $usuario->confirmado = 1;
                $usuario->token = null;
                $usuario->guardar(false);
                if ($usuario->guardar(false)) {
                    $errores[] = ["tipo" => "exito", "mensaje" => "Cuenta confirmada correctamente"];
                }
            }

            $router->render("auth/confirmar-cuenta", [
                "errores" => $errores,
                "titulo" => $titulo,
                "descripcion" => $descripcion,
                "categorias" => $categorias
            ]);
        }


        public static function login(Router $router) {
            $titulo = "BookSpot - Login";
            $descripcion = "Inicia Sesión";
            $errores = [];
            $categorias = Categoria::all();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $auth = new Usuario($_POST);
                $errores = $auth->validarLogin();

                if($_SERVER["REQUEST_METHOD"] === "POST") {
                    $usuario =  Usuario::where("email", $auth->email);

                    if($usuario) {
                        // Verificar el password
                        if($usuario->comprobarPasswordAndVerificado($auth->password)) {
                            // Autenticar al usuario
                            session_start();
                            $_SESSION["id"] = $usuario->id;
                            $_SESSION["nombre"] = $usuario->nombre . " " . $usuario->apellido;
                            $_SESSION["email"] = $usuario->email;
                            $_SESSION["login"] = true;
                            $_SESSION["admin"] = (int)$usuario->admin; // Define si es administrador
                            // Redireccionamiento
                            header("Location: /bookspot/public/index.php");
                        } else {
                            $errores[] = "Password incorrecto o cuenta no confirmada";
                        }
                    } else {
                        $errores[] = "Usuario no encontrado";
                    }
                }
            }
            $router->render('auth/login', [
                'errores' => $errores,
                "titulo" => $titulo,
                "descripcion" => $descripcion,
                "categorias" => $categorias
            ]);
        }


        public static function olvide(Router $router) {
            $titulo = "BookSpot - Olvde Password";
            $descripcion = "Restablecer password";
            $errores = [];
            $categorias = Categoria::all();   
                     
            if($_SERVER["REQUEST_METHOD"] === "POST") {
                $auth = new Usuario($_POST);
                $errores = $auth->validarEmail();

                if(empty($errores)) {
                    $usuario = Usuario::where("email", $auth->email);

                    if($usuario && $usuario->confirmado === "1") {
                        $usuario->crearToken();
                        if($usuario->guardar(false)) {
                            $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                            $email->enviarInstrucciones();
                            $errores[] = ["tipo" => "exito", "mensaje" => "Revisa tu Email"];
                        }
                    } else {
                        $errores[] = ["tipo" => "error", "mensaje" => "El usuario no existe o no está confirmado"];
                    }
                }
            }
            $router->render("auth/olvide-password", [
                "errores" => $errores,
                "titulo" => $titulo,
                "descripcion" => $descripcion,
                "categorias" => $categorias
            ]);
        }


        public static function recuperar(Router $router) {
            $titulo = "BookSpot - Recuperar Password";
            $descripcion = "Recuperar password";
            $categorias = Categoria::all();   
            $errores = [];
            $errorToken = false;
            $token = s($_GET["token"]);
            $usuario = Usuario::where("token", $token);

            if(empty($usuario)) {
                $errores[] = ["tipo" => "error", "mensaje" => "Token no válido"];
                $errorToken = true;
            }
            
            if($_SERVER["REQUEST_METHOD"] === "POST") {
                // Leer el nuevo password y guardarlo
                $password = new Usuario($_POST);
                $errores = $password->validarPassword();

                if(empty($errores)) {
                    $usuario->password = null;
                    $usuario->password = $password->password;
                    $usuario->hashPassword();
                    $usuario->token = null;

                    $resultado = $usuario->guardar(false);

                    if($resultado) {
                        header("Location: login");
                    }
                }
            }
            
            $router->render("auth/recuperar-password", [
                "errores" => $errores,
                "errorToken" => $errorToken,
                "titulo" => $titulo,
                "descripcion" => $descripcion,
                "categorias" => $categorias
            ]);
        }


        public static function logout() {
            session_start();
            $_SESSION = [];
            header('Location: /bookspot/public/index.php');
        }
    }