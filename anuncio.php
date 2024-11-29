<?php
    require "includes/app.php";
    $titulo = "Bookspot - Anuncio";
    $descripcion = "El producto que seleccionaste";
    use App\Libro;
    use App\Categoria;
    $categorias = Categoria::all();

    // Validar la URL por ID válido
    $id = filter_var($_GET["id"] ?? null, FILTER_VALIDATE_INT);
    if (!$id) {
        header("Location: ./");
        exit;
    }

    $libro = Libro::find($id);

    if (!$libro) {
        header("Location: ./");
        exit;
    }

    incluirTemplate("header", false, $titulo, $descripcion, ['categorias' => $categorias]);
?>

    <main class="contenedor seccion">
        <h1><?php echo s($libro->titulo) . " - " . s($libro->autor); ?></h1>

        <section class="anuncio-detalles">
            <div class="imagen-libro">
                <img src="imagenes/<?php echo s($libro->imagen); ?>" alt="Imagen Libro">
            </div>
    
            <div class="detalles-libro">
                <h2>Descripción</h2>
                <p><?php echo s($libro->descripcion); ?></p>
                
                <h2>Detalles</h2>
                <ul>
                    <li><strong>Título: </strong><?php echo s($libro->titulo); ?></li>
                    <li><strong>Autor: </strong><?php echo s($libro->autor); ?></li>
                    <li><strong>Editorial: </strong><?php echo s($libro->editorial); ?></li>
                    <li><strong>Categoría: </strong><?php echo s($libro->categoria); ?></li>
                    <p class="precio-libro">$ <?php echo s($libro->precio); ?></p>
                </ul>
    
                <button class="boton-naranja">Agregar al carrito</button>
            </div>
        </section>
    </main>
    
<?php
    incluirTemplate("footer");
?>