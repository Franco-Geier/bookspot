<?php
    namespace Controllers;
    use MVC\Router;
    use Model\Libro;
    use Model\Categoria;
    use Model\Contacto;
    use PHPMailer\PHPMailer\PHPMailer;

    class PaginasController {
        public static function index(Router $router) {
            $inicio = true;
            $titulo = "BookSpot - Inicio";
            $descripcion = "BookSpot es la mejor página web para comprar libros.";
            $libros = Libro::librosConRelaciones(3);
            $categorias = Categoria::all();

            $router->render("paginas/index", [
                "libros" => $libros,
                "categorias" => $categorias,
                "inicio" => $inicio,
                "titulo" => $titulo,
                "descripcion" => $descripcion
            ]);
        }


        public static function nosotros(Router $router) {
            $titulo = "BookSpot - Nosotros";
            $descripcion = "Conoce más sobre BookSpot, la página web líder en venta de libros";
            $categorias = Categoria::all();

            $router->render("paginas/nosotros", [
                "categorias" => $categorias,
                "titulo" => $titulo,
                "descripcion" => $descripcion
            ]);
        }


        public static function libros(Router $router) {
            $titulo = "BookSpot - Libros";
            $descripcion = "Mira nuestros libros en venta.";
            $libros = Libro::librosConRelaciones();
            $categorias = Categoria::all();

            $router->render("paginas/libros", [
                "categorias" => $categorias,
                "libros" => $libros,
                "titulo" => $titulo,
                "descripcion" => $descripcion
            ]);
        }


        public static function libro(Router $router) {
            $id = validarORedireccionar("../");
            $titulo = "Bookspot - Libro";
            $descripcion = "El producto que seleccionaste";
            $libro = Libro::find($id);
            $categorias = Categoria::all();

            if (!$libro) {
                header("Location: ../");
                exit;
            }

            $router->render("paginas/libro", [
                "categorias" => $categorias,
                "libro" => $libro,
                "titulo" => $titulo,
                "descripcion" => $descripcion
            ]);
        }


        public static function categorias(Router $router) {
            $id = validarORedireccionar("../");
            $titulo = "BookSpot - Categorías";
            $descripcion = "Mira los libros de la categoría seleccionada.";
            $categorias = Categoria::all();

            // Obtener los libros que pertenecen a la categoría seleccionada
            $libros = Libro::where('id_categoria', $id) ?? [];

            // Comprobar si la categoría existe
            $categoria = Categoria::find($id);
            if (!$categoria) {
                header("Location: ../");
                exit;
            }

            $router->render("paginas/categorias", [
                "categorias" => $categorias,
                "libros" => $libros,
                "categoria" => $categoria,
                "titulo" => $titulo,
                "descripcion" => $descripcion
            ]);
        }


        public static function blog(Router $router) {
            $titulo = "BookSpot - Blog";
            $descripcion = "Mira nuestras nuestras entradas de blog.";
            $categorias = Categoria::all();

            $router->render("paginas/blog", [
                "categorias" => $categorias,
                "titulo" => $titulo,
                "decripcion" => $descripcion
            ]);

        }


        public static function entrada(Router $router) {
            $titulo = "BookSpot - Entrada";
            $descripcion = "Visita nuestra entrada del blog";
            $categorias = Categoria::all();

            $router->render("paginas/entrada", [
                "categorias" => $categorias,
                "titulo" => $titulo,
                "decripcion" => $descripcion
            ]);
        }


        public static function contacto(Router $router) {
            $titulo = "BookSpot - Contacto";
            $descripcion = "Contáctanos si tienes dudas";
            $mensaje = null;
            $errores = [];
            $categorias = Categoria::all();
            $respuestas = new Contacto($_POST["contacto"] ?? []);

            if($_SERVER["REQUEST_METHOD"] === "POST") {
                // Sanitizar datos
                $respuestas->sanitizar();
                // Validar datos
                $errores = $respuestas->validar();

                if (empty($errores)) {
                    // Crear una instancia de PHPMailer
                    $mail = new PHPMailer();
                    // Configurar SMTP (Protocolo)
                    $mail->isSMTP();
                    $mail->Host = "sandbox.smtp.mailtrap.io";
                    $mail->SMTPAuth = true;
                    $mail->Username = 'b0ba581ebf57f6';
                    $mail->Password = '189d63aa39f836';
                    $mail->SMTPSecure = "tls";
                    $mail->Port = 2525;

                    // Configurar el contenido del mail
                    $mail->setFrom("admin@bookspot.com"); // Quien envia el email
                    $mail->addAddress("admin@bookspot.com", "BookSpot.com"); // A que email va a llegar el correo
                    
                    // Habilitar HTML
                    $mail->isHTML(true);
                    $mail->CharSet = "UTF-8";

                    // Contenido
                    $mail->Subject = "Tienes un nuevo mensaje"; // El asunto que el usuario va a leer
                    
                    $contenido = "<html>";
                    $contenido .= "<p>Tienes un nuevo mensaje</p>";
                    $contenido .= "<p>Nombre: " . $respuestas["nombre"] . "</p>";
                    $contenido .= "<p>Apellido: " . $respuestas["apellido"] . "</p>";

                    // Enviar de forma condicional algunos campos de email o teléfono
                    if ($respuestas["contacto"] === "telefono") {
                        $contenido .= "<p>Eligió ser contactado por Teléfono:</p>";
                        $contenido .= "<p>Teléfono: " . ($respuestas["tel"] ?? "No especificado") . "</p>";
                        $contenido .= "<p>Fecha contacto: " . ($respuestas["fecha"] ?? "No especificado") . "</p>";
                        $contenido .= "<p>Hora: " . ($respuestas["hora"] ?? "No especificado") . "</p>";
                    } else { 
                        $contenido .= "<p>Eligió ser contactado por Email:</p>";
                        $contenido .= "<p>Email: " . ($respuestas["email"] ?? "No especificado") . "</p>";
                    }

                    $contenido .= "<p>Mensaje: " . ($respuestas["mensaje"] ?? "No especificado") . "</p>";
                    $contenido .= "</html>";
                    
                    $mail->Body = $contenido;
                    $mail->AltBody = "Esto es un texto alternativo sin HTML";

                    // Envira el mail
                    if($mail->send()) {
                        $mensaje = "Mensaje enviado correctamente";
                    } else {
                        $mensaje = "El mensaje no se pudo enviar...";
                    }
                }
            }

            $router->render("paginas/contacto", [
                "categorias" => $categorias,
                "titulo" => $titulo,
                "descripcion" => $descripcion,
                "mensaje" => $mensaje,
                "errores" => $errores,
                "respuestas" => $respuestas
            ]);
        }
    }


