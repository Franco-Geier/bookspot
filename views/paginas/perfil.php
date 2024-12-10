<main class="contenedor seccion">
    <h1>Mi Perfil</h1>

    <div class="contenido-centrado">
        <p><strong>Nombre:</strong> <?php echo s($usuario->nombre); ?></p>
        <p><strong>Apellido:</strong> <?php echo s($usuario->apellido); ?></p>
        <p><strong>Email:</strong> <?php echo s($usuario->email); ?></p>
        <p><strong>Fecha de Registro:</strong> <?php echo s($usuario->fecha_registro); ?></p>
    </div>
</main>