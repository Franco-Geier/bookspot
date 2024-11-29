<?php
    require "includes/app.php";
    $db = conectarBD();

    $errores = [];

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = mysqli_real_escape_string($db, filter_var($_POST["email"], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST["password"]);
    
        if(!$email) {
            $errores[] = "El mail es obligatorio";
        }

        if(!$password) {
            $errores[] = "El password es obligatorio";
        }

        if(empty($errores)) {
            $query = "SELECT * FROM admins WHERE email = '${email}'";
            $resultado = mysqli_query($db, $query);

            if($resultado->num_rows) {
                $admin = mysqli_fetch_assoc($resultado);
                $auth = password_verify($password, $admin["password"]);

                if($auth) {
                    // El admin está autenticado
                    session_start();

                    $_SESSION["admin"] = $admin["email"];
                    $_SESSION["login"] = true;

                    header("Location: admin/");

                } else {
                    $errores[] = "El password es incorrecto";
                }
            } else {
                $errores [] = "El admin no existe";
            }
        }
    }

    $titulo = "Bookspot - Login-Admins";
    $descripcion = "inicia sesión como admin";
    use App\Categoria;
    $categorias = Categoria::all();
    incluirTemplate("header", false, $titulo, $descripcion, ['categorias' => $categorias]);
?>
    <main class="contenedor seccion">
        <h1>Iniciar Sesión</h1>

        <div class="contenedor-alertas">
            <?php foreach($errores as $error): ?>
                <div class="alerta error">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endforeach; ?>
        </div>

        <form method="POST" class="formulario">
            <fieldset>
                <legend>Completa el Formulario</legend>            
                    <div class="campo">
                        <label for="email">E-mail</label>
                        <input type="email" placeholder="Tu Email" name="email" autocomplete="email" id="email">
                    </div>

                    <div class="campo">           
                        <label for="password">Password</label>
                        <input type="password" placeholder="Tu Password" name="password" autocomplete="current-password" id="password">
                    </div>
            </fieldset>
            <input type="submit" value="Iniciar Sessión" class="boton-verde">
        </form>
    </main>

<?php
    incluirTemplate("footer");
?>