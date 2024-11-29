<?php
    require "includes/app.php";
    $titulo = "BookSpot - Categorías";
    $descripcion = "Mira los libros de la categoría seleccionada.";
    use App\Libro;
    use App\Categoria;
    $categorias = Categoria::all();

    // Validar la URL por ID válido
    $id = filter_var($_GET["id"] ?? null, FILTER_VALIDATE_INT);
    if (!$id) {
        header("Location: ./");
        exit;
    }

    // Obtener los libros que pertenecen a la categoría seleccionada
    $libros = Libro::where('id_categoria', $id) ?? [];

    // Comprobar si la categoría existe
    $categoria = Categoria::find($id);
    if (!$categoria) {
        header("Location: ./"); // Redirige al inicio si la categoría no existe
        exit;
    }

    // Incluir el header
    incluirTemplate("header", false, $titulo, $descripcion, ['categorias' => $categorias]);
?>

    <main class="contenedor seccion">
        <h1>Libros en la categoría: <?php echo s($categoria->nombre); ?></h1>
            <?php
                include "includes/templates/anuncios.php";
            ?>
        </div>
    </main>

<?php
    incluirTemplate("footer");
?>
