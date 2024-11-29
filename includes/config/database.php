<?php

function conectarBD() : mysqli {
    $db = new mysqli("localhost", "root", "root", "bookspot");

    if(!$db) {
        echo "No se pudo conectar";
        exit;
    }

    return $db;
}