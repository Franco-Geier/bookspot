<?php

    require "../../includes/app.php";
    $titulo = "BookSpot - Crear";
    $descripcion = "Zona de creación de libros.";

    estaAutenticado();

    use App\Libro;
    use App\Categoria;
    use App\Editorial;
    use Intervention\Image\ImageManager;
    use Intervention\Image\Drivers\GD\Driver;

    header('Content-Type: text/html; charset=UTF-8');

    // Instanciar el objeto
    $libro = new Libro;

    $categorias = Categoria::all(); // Obtiene todas las categorías
    $editoriales = Editorial::all(); // Obtiene todas las editoriales

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
    incluirTemplate("header", false, $titulo, $descripcion, ['categorias' => $categorias]);
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="../../admin" class="boton boton-verde">Volver</a>
        
        <!-- Alertas -->
        <div class="contenedor-alertas">
            <?php foreach($errores as $error): ?>
                <div class="alerta error">
                    <?php echo s($error); ?>
                </div>
            <?php endforeach; ?>
        </div>

        <form class="formulario mt-3" method="POST" action="./libros/crear.php" enctype="multipart/form-data">
            <?php include "../../includes/templates/formulario_libros.php"; ?>

            <input type="submit" value="Crear Libro" class="boton-verde">
        </form>
    </main>

<?php
    incluirTemplate("footer");
?>