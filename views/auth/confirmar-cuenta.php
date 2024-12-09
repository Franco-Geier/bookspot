<main class="contenedor seccion">
    <h1>Confirmar Cuenta</h1>
    <div class="contenedor-alertas">
        <?php foreach ($errores as $error): ?>
            <div class="alerta <?php echo s($error['tipo']); ?>">
                <?php echo s($error['mensaje']); ?>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="acciones contenedor-alertas">
        <a href="login">Iniciar Sesión</a>
    </div>
</main>