<?php
    if(!isset($_SESSION))
    {
        session_start();
    }

    $auth = $_SESSION["login"] ?? false;

    if(!isset($inicio)) {
        $inicio = false;
    }

    if(!isset($isAdmin)) {
        $isAdmin = false;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo s($titulo, ENT_QUOTES, 'UTF-8'); ?></title>
    <meta name="description" content="<?php echo s($descripcion, ENT_QUOTES, 'UTF-8'); ?>">
    <!-- Preload del CSS de normalización -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/modern-normalize/3.0.1/modern-normalize.min.css" integrity="sha512-q6WgHqiHlKyOqslT/lgBgodhd03Wp4BEqKeW6nNtlOY4quzyG3VoQKFrieaCeSnuVseNKRGpGeDU3qPmabCANg==" crossorigin="anonymous" as="style"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/modern-normalize/3.0.1/modern-normalize.min.css" integrity="sha512-q6WgHqiHlKyOqslT/lgBgodhd03Wp4BEqKeW6nNtlOY4quzyG3VoQKFrieaCeSnuVseNKRGpGeDU3qPmabCANg==" crossorigin="anonymous"/>
    <!-- Fuente -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/bookspot/public/build/css/app.css">
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : '';?>">
        <div class="contenedor contenido-header">
            <nav class="navbar navbar-expand-lg py-4 pe-0 fixed-top <?php echo $inicio ? 'principal transparent' : ''; ?>" data-bs-theme="dark">
                <div class="contenedor container-fluid p-0">
                    <a href="/bookspot/public/index.php" class="m-auto m-lg-0">
                        <img class="navbar-brand m-0" src="/bookspot/public/build/img/logo.svg" alt="Logotipo de CarHub">
                    </a>

                    <button class="navbar-toggler border-white border-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                        <div class="offcanvas-header justify-content-end">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>

                        <div class="ps-5 offcanvas-body navegacion justify-content-end align-items-center">
                            <ul class="navbar-nav me-lg-4">
                                <li class="nav-item"><a class="nav-link p-0" href="/bookspot/public/index.php/nosotros">Nosotros</a></li>
                                <li class="nav-item"><a class="nav-link p-0" href="/bookspot/public/index.php/blog">Blog</a></li>
                                <li class="nav-item"><a class="nav-link p-0" href="/bookspot/public/index.php/contacto">Contacto</a></li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle p-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categorías</a>
                                    <ul class="dropdown-menu">
                                        <?php if (!empty($categorias)): ?>
                                            <?php foreach ($categorias as $categoria): ?>
                                                <li>
                                                    <a class="dropdown-item" href="/bookspot/public/index.php/categorias?id=<?php echo s($categoria->id); ?>">
                                                        <?php echo s($categoria->nombre); ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <li><a class="dropdown-item" href="#">No hay categorías disponibles</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <?php if($auth && $isAdmin) :?>
                                    <li class="nav-item">
                                        <a class="nav-link p-0" href="/bookspot/public/index.php/logout-admin">Cerrar Sesión</a>
                                    </li>
                                <?php endif; ?> 
                            </ul>
                            
                            <form class="d-flex my-4 my-lg-0" role="search">
                                <input class="form-control me-lg-4" type="search" placeholder="Buscar" aria-label="Search">
                            </form>

                            <img class="dark-mode-boton" src="/bookspot/public/build/img/dark-mode.svg" alt="Icono DarkMode">
                        </div>
                    </div>
                </div>
            </nav>

            <?php if($inicio) { ?>
                <div>
                    <h2>BookSpot página web para venta de libros</h2>
                </div>
            <?php } ?>
        </div>
    </header>



    <?php echo $contenido; ?>



    <footer class="footer seccion">
            <div class="contenedor contenedor-footer">
                <nav class="navegacion-footer navegacion">
                    <ul>
                        <li><a href="/bookspot/public/index.php/nosotros">Nosotros</a></li>
                        <li><a href="/bookspot/public/index.php/blog">Blog</a></li>
                        <li><a href="/bookspot/public/index.php/contacto">Contacto</a></li>
                        <li><a href="/bookspot/public/index.php/libros">Libros</a></li>
                    </ul>
                </nav>
            </div>
            <p class="copyright">Todos los derechos reservados <?php echo date("Y"); ?> &copy;</p>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="/bookspot/public/build/js/bundle.min.js"></script>
</body>
</html>