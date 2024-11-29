<?php
require_once __DIR__ . '/funciones.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$productos = obtenerProductoPorId($_GET['id']);

if (!$productos) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $count = actualizarProducto(
            $_GET['id'],
            $_POST['nombre'],
            $_POST['precio'],
            $_POST['categoria'],
            $_POST['descripcion'],
            isset($_POST['disponible'])
        );
        if ($count > 0) {
            header("Location: index.php");
            exit;
        } else {
            $error = "No se pudo actualizar el pedido.";
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar pedido</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <h1 style="left: 20%;">Editar el registro del pedido</h1>

        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="post">
            <label>Nombre:
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($productos['nombre']); ?>" required>
            </label><br>

            <label>Precio:
                <input type="number" name="precio" step="0.01" value="<?php echo htmlspecialchars($productos['precio']); ?>" required>
            </label><br>

            <label>Categoria:
                <select name="categoria">
                    <option value="Hamburguesa" <?php echo $productos->categoria === 'Hamburguesa' ? 'selected' : ''; ?>>Hamburguesa</option>
                    <option value="Salchipapa" <?php echo $productos->categoria === 'Salchipapa' ? 'selected' : ''; ?>>Salchipapa</option>
                    <option value="Pollo a la brasa" <?php echo $productos->categoria === 'Pollo a la brasa' ? 'selected' : ''; ?>>Pollo a la brasa</option>
                    <option value="Pollo broster" <?php echo $productos->categoria === 'Pollo broster' ? 'selected' : ''; ?>>Pollo broster</option>
                    <option value="Anticucho" <?php echo $productos->categoria === 'Anticucho' ? 'selected' : ''; ?>>Anticucho</option>
                </select>
            </label><br>

            <label>Descripcion:
                <textarea name="descripcion" required><?php echo htmlspecialchars($productos['descripcion']); ?></textarea>
            </label>

            <label>Disponible:
                <input type="checkbox" name="disponible" <?php echo $productos->disponible ? 'checked' : ''; ?>>
            </label><br>

            <button type="submit" class="button">Actualizar</button>
            <a href="index.php" >Volver</a>
        </form>
    </div>
</body>

</html>