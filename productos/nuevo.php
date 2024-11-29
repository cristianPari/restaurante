<?php
require_once __DIR__ . '/../productos/funciones.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = crearProducto($_POST['nombre'], $_POST['precio'], $_POST['categoria'], $_POST['descripcion']);

    if ($id) {
        header("Location: index.php");
        exit;
    } else {
        $error = "No se pudo crear el pedido";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo pedido</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <h1 style="left: 20%;">AGREGAR UN NUEVO PEDIDO</h1>

        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif ?>

        <form method="post">
            <label>Nombre: <input type="text" name="nombre" required></label><br>
            <label>Precio: <input type="number" step="0.01" name="precio"  required></label><br>
            <label>Categoria: <br> <select name="categoria">
                    <option value="Hamburguesa">Hamburguesa</option>
                    <option value="Salchipapa">Salchipapa</option>
                    <option value="Pollo a la brasa">Pollo a la brasa</option>
                    <option value="Pollo broster">Pollo broster</option>
                    <option value="Anticucho">Anticucho</option>
                </select></label><br>
            <label>Descripcion: <textarea name="descripcion" ></textarea></label><br>

            <button type="submit" class="button">Registrar</button>
        </form>
        <br>
        <a href="index.php">Ver la lista de los pedidos</a>
    </div>
</body>

</html>