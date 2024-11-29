<?php
    require "includes/app.php";
    $titulo = "BookSpot - Anuncios";
    $descripcion = "Mira nuestras ofertas.";
    incluirTemplate("header", $inicio = false, $titulo, $descripcion);
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
