<?php
    namespace Controllers;

    use Model\Libro;
    use Model\Categoria;
    use MVC\Router;

    class BuscarController {
        public static function buscar($router) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $query = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING);
                if (!$query) {
                    die("No se proporcionó un término de búsqueda.");
                }

                // Buscar en la base de datos
                $libros = Libro::buscar($query);
                $categorias = Categoria::buscar($query);

                $titulo = "Resultados para: " . $query;

                // Renderizar los resultados
                $router->render('paginas/buscar', [
                    'titulo' => $titulo,
                    'query' => $query,
                    'libros' => $libros,
                    'categorias' => $categorias,
                ]);
            }
        }
    }