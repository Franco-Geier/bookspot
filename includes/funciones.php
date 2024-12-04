<?php

    define("TEMPLATES_URL", __DIR__ . "/templates");
    define("FUNCIONES_URL", __DIR__ . "funciones.php");
    define("CARPETA_IMAGENES", "imagenes/");

    function debuguear($variable) {
        echo "<pre>";
            var_dump($variable);
        echo "</pre>";
        exit;
    }

    // Escapar/Sanitizar HTML
    function s($html) : string {
        $s = htmlspecialchars($html);
        return $s;
    }

    // Muestra los mensajes
    function mostrarNotificacion($codigo) {
        $mensaje = "";

        switch ($codigo) {
            case 1:
                $mensaje = "Creado Correctamente";
                break;
            case 2:
                $mensaje = "Actualizado Correctamente";
                break;
            case 3:
                $mensaje = "Eliminado Correctamente";
                break;
            
            default:
                $mensaje = false;
                break;
        }
        return $mensaje;
    }

    
    function validarORedireccionar(string $url) {
        // Validar la URL por ID válido
        $id = filter_var($_GET["id"] ?? null, FILTER_VALIDATE_INT);
        if (!$id) {
            header("location: $url");
            exit;
        }
        return $id;
    }