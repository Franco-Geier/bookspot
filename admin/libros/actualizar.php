<?php

    require "../../includes/app.php";

    use App\Libro;
    use App\Categoria;
    use App\Editorial;
    use Intervention\Image\ImageManager;
    use Intervention\Image\Drivers\GD\Driver;

    estaAutenticado();

    // Validar la URL por ID válido
    $id = filter_var($_GET["id"] ?? null, FILTER_VALIDATE_INT);
    if (!$id) {
        header("location: ../../admin");
        exit;
    }

    header('Content-Type: text/html; charset=UTF-8');

    // Obtener los datos de los libros
    $libro = Libro::find($id);
    
    if (!$libro) {
        header("Location: ../../admin");
        exit;
    }

    $categorias = Categoria::all(); // Obtiene todas las categorías
    $editoriales = Editorial::all(); // Obtiene todas las editoriales

    // Arreglo con mensajes de errores
    $errores = Libro::getErrores();

    // Ejecutar el código después de que el ususario envia el formulario
    if($_SERVER["REQUEST_METHOD"] === "POST") {

        // Asignar los atributos
        $args = $_POST["libro"];
        
        $libro->sincronizar($args);

        // Validación
        $errores = $libro->validar();

        // Generar un nombre único para la imagen
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        /** SETEAR LA IMAGEN **/
        if($_FILES["libro"]["tmp_name"]["imagen"]) {

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
    incluirTemplate("header");
?>

    <main class="contenedor seccion">
        <h1>Actualizar</h1>

        <a href="../../admin" class="boton boton-verde">Volver</a>
        
        <!-- Alertas -->
        <div class="contenedor-alertas">
            <?php foreach($errores as $error): ?>
                <div class="alerta error">
                    <?php echo s($error); ?>
                </div>
            <?php endforeach; ?>
        </div>

        <form class="formulario mt-3" method="POST" enctype="multipart/form-data">
                <?php include "../../includes/templates/formulario_libros.php"; ?>

            <input type="submit" value="Actualizar Libro" class="boton-verde">
        </form>
    </main>

<?php
    incluirTemplate("footer");
?>