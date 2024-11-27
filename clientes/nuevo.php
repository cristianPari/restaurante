<?php
require_once __DIR__ . '/funciones.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = crearCliente($_POST['nombre'], $_POST['correo'], $_POST['telefono'], $_POST['direccion']);

    if ($id) {
        header("Location: index.php");
        exit;
    } else {
        $error = "No se pudo crear un nuevo cliente";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Cliente</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <h1 style="left: 20%;">Registrar datos del Cliente</h1>

        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?> </p>
        <?php endif ?>

        <form method="post">
            <label>Nombre: <input type="text" name="nombre" required></label><br>
            <label>Correo: <input type="email" name="correo" required></label><br>
            <label>Telefono: <input type="tel" name="telefono" required></label><br>
            <label>Direccion: <input type="text" name="direccion" required></label><br>

            <input type="submit" value="Registrar" class="button">
        </form>
        <a href="../clientes/index.php">Regresar</a>
    </div>
</body>

</html>