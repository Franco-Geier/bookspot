<?php
    require "includes/app.php";
    $titulo = "BookSpot - Anuncios";
    $descripcion = "Mira nuestros libros en venta.";
    use App\Categoria;
    $categorias = Categoria::all();
    incluirTemplate("header", false, $titulo, $descripcion, ['categorias' => $categorias]);
?>

    <main class="contenedor seccion">
        <h1>Libros en venta</h1>

        <?php
            incluirTemplate("anuncios");
        ?>
    </main>
    
<?php
    incluirTemplate("footer");
?>
