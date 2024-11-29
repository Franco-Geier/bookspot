<?php

    require "includes/app.php";
    $db = conectarBD();

    // Mail y contraseña
    $email = "francoyogeier@gmail.com";
    $password = "Cs]rdr%TLVD}$";

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // Query para crear el usuario
    $query = "INSERT INTO admins (email, password) VALUES ('${email}', '${passwordHash}');";

    // Agregarlo a la BD
    mysqli_query($db, $query);

    // Cerrar la conexion
    mysqli_close($db);
