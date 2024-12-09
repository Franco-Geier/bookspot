<?php

    namespace Controllers;
    use MVC\Router;
    use Model\Libro;
    use Model\Categoria;
    use Model\Editorial;
    use Intervention\Image\ImageManager;
    use Intervention\Image\Drivers\GD\Driver;

    class LibroController {

        public static function index(Router $router) {

            if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== 1) {
                header("Location: /bookspot/public/index.php");
                exit;
            }
            $titulo = "BookSpot - Admin";
            $descripcion = "Zona de administración de libros.";
            $libros = Libro::librosConRelaciones();
            $categorias = Categoria::all();
            // Muestra mensaje condicional
            $resultado = $_GET["resultado"] ?? null;

            $router->render("libros/admin", [
                "categorias" => $categorias,
                "libros" => $libros,
                "resultado" => $resultado,
                "titulo" => $titulo,
                "descripcion" => $descripcion,
                "isAdmin" => true
            ]);
        }


        public static function crear(Router $router) {
            if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== 1) {
                header("Location: /bookspot/public/index.php");
                exit;
            }
            $titulo = "BookSpot - Crear";
            $descripcion = "Zona de creación de libros.";
            $libro = new Libro;
            $categorias = Categoria::all();
            $editoriales = Editorial::all();
            // Arreglo con mensajes de errores
            $errores = Libro::getErrores();

            // Ejecutar el código después de que el ususario envia el formulario
            if($_SERVER["REQUEST_METHOD"] === "POST") {

                // Crea una instancia
                $libro = new Libro($_POST["libro"]);

                /** SETEAR LA IMAGEN **/
                if($_FILES["libro"]["tmp_name"]["imagen"]) {
                    // Generar un nombre único para la imagen
                    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                    // Crear instancia del driver y del ImageManager
                    $manager = new ImageManager(new Driver());
                    // Procesar la imagen con el método read
                    $imagen = $manager->read($_FILES["libro"]["tmp_name"]["imagen"]); // Cargar la imagen
                    
                    // Redimensionar y ajustar la imagen (por ejemplo, 800x600)
                    $imagen->cover(800, 600);
                    $libro->setImagen($nombreImagen);
                }
                
                // Validar
                $errores = $libro->validar();

                // Revisar que el arreglo de errores esté vacío
                if(empty($errores)) {

                    if(!is_dir(CARPETA_IMAGENES)) {
                        mkdir(CARPETA_IMAGENES);
                    }
                    // Guardar la imagen en el servidor
                    $imagen->save(CARPETA_IMAGENES . $nombreImagen);

                    /** SUBIDA DE ARCHIVOS **/
                    $libro->guardar();
                }
            }

            $router->render("libros/crear", [
                "libro" => $libro, 
                "categorias" => $categorias,
                "editoriales" => $editoriales,
                "errores" => $errores,
                "titulo" => $titulo,
                "descripcion" => $descripcion,
                "isAdmin" => true
            ]);
        }


        public static function actualizar(Router $router) {
            if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== 1) {
                header("Location: /bookspot/public/index.php");
                exit;
            }
            $titulo = "BookSpot - Actualizar";
            $descripcion = "Zona de actualización de libros.";
            $id = validarORedireccionar("../admin");
            $libro = Libro::find($id);

            if (!$libro) {
                header("Location: ../admin");
                exit;
            }

            $categorias = Categoria::all();
            $editoriales = Editorial::all();
            // Arreglo con mensajes de errores
            $errores = Libro::getErrores();

            // Método POST para actualizar
            if($_SERVER["REQUEST_METHOD"] === "POST") {
                // Asignar los atributos
                $args = $_POST["libro"];
                
                $libro->sincronizar($args);
        
                // Validación
                $errores = $libro->validar();
        
                /** SETEAR LA IMAGEN **/
                if($_FILES["libro"]["tmp_name"]["imagen"]) {
                    // Generar un nombre único para la imagen
                    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                    // Crear instancia del driver y del ImageManager
                    $manager = new ImageManager(new Driver());
                    // Procesar la imagen con el método read
                    $imagen = $manager->read($_FILES["libro"]["tmp_name"]["imagen"]); // Cargar la imagen
                    
                    // Redimensionar y ajustar la imagen (por ejemplo, 800x600)
                    $imagen->cover(800, 600);
                    $libro->setImagen($nombreImagen);
                }
        
                // Revisar que el arreglo de errores esté vacío
                if(empty($errores)) {
                    if($_FILES["libro"]["tmp_name"]["imagen"]) {
                        // Guardar la imagen en el servidor
                        $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                    }
                    $libro->guardar();
                }
            }

            $router->render("libros/actualizar", [
                "libro" => $libro,
                "categorias" => $categorias,
                "editoriales" => $editoriales,
                "errores" => $errores,
                "titulo" => $titulo,
                "descripcion" => $descripcion,
                "isAdmin" => true
            ]);
        }


        public static function eliminar() {
            if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== 1) {
                header("Location: /bookspot/public/index.php");
                exit;
            }
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                // Validar ID
                $id = $_POST["id"] ?? null;
                $id = filter_var($id, FILTER_VALIDATE_INT);
        
                if($id) {
                    $libro = Libro::find($id);
                    $libro->eliminar();
                }
            }
        
        }
    }