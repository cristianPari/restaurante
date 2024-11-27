<?php
require_once __DIR__ . '/funciones.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$clientes = obtenerClientePorId($_GET['id']);

if (!$clientes) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $count = actualizarCliente($_GET['id'], $_POST['nombre'], $_POST['correo'], $_POST['telefono'], $_POST['direccion']);

    if ($count > 0) {
        header("Location: index.php");
        exit;
    } else {
        $error = "No se pudo actualizar el registro del cliente";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar registro del cliente</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <h1 style="left: 20%;">Editar registro del cliente</h1>

        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error ?></p>
        <?php endif ?>

        <form method="post">
            <label>Nombre: <input type="text" name="nombre" value="<?php echo htmlspecialchars($clientes['nombre']); ?>" required></label><br>
            <label>Correo: <input type="email" name="correo" value="<?php echo htmlspecialchars($clientes['correo']); ?>" required></label><br>
            <label>Telefono: <input type="tel" name="telefono" value="<?php echo htmlspecialchars($clientes['telefono']); ?>" required></label><br>
            <label>Direccion: <input type="text" name="direccion" value="<?php echo htmlspecialchars($clientes['direccion']); ?>" required></label><br>

            <input type="submit" value="Actualizar" class="button">
        </form>
        <a href="../clientes/index.php">Regresar</a>
    </div>
</body>

</html>