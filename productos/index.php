<?php
require_once __DIR__ . '/../productos/funciones.php';

// Sanitizar los parámetros de entrada
$accion = isset($_GET['accion']) ? sanitizeInput($_GET['accion']) : null;
$id = isset($_GET['id']) ? sanitizeInput($_GET['id']) : null;

if ($accion && $id) {
    switch ($accion) {
        case 'eliminar':
            $count = eliminarProducto($id);
            $mensaje = $count > 0 ? "Producto eliminado exitosamente." : "No se pudo eliminar el producto.";
            break;
        case 'toggleCompleta':
            $nuevoEstado = toggleProductoDisponible($id);
            $mensaje = $nuevoEstado !== null ? 
                ($nuevoEstado ? "Producto disponible." : "Producto NO disponible.") : 
                "No se pudo cambiar el estado del producto.";
            break;
    }       
}

$productos = obtenerProducto();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Lista de productos</h1>

        <?php if (isset($mensaje)): ?>
            <div class="<?php echo isset($count) && $count > 0 ? 'success' : 'error'; ?>">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
        <img style="position: absolute; left:37%; width: 200px;" src="https://images.rappi.pe/restaurants_logo/a5cb83bc-fe90-421e-b7e2-9a020606bcdb-1618923957931.jpeg" ><br>

        <a href="nuevo.php" class="button">Agregar un nuevo pedido</a><br><br>
        <a href="../index.php" style="left: 9%; position:relative;">Regresar</a>


        <h2>Lista de pedidos</h2>
        <table>
            <tr>
                <th>Nombre:</th>
                <th>Precio:</th>
                <th>Categoría:</th>
                <th>Descripción:</th>
                <th>Disponible:</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                <td><?php echo htmlspecialchars($producto['precio']); ?></td>
                <td><?php echo htmlspecialchars($producto['categoria']); ?></td>
                <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
                <td><?php echo $producto['disponible'] ? 'Sí' : 'No'; ?></td>
                <td class="actions">
                    <a href="editar.php?id=<?php echo (string)$producto['_id']; ?>" class="button">Editar</a>
                    <a href="index.php?accion=eliminar&id=<?php echo (string)$producto['_id']; ?>" class="button" onclick="return confirm('¿Estás seguro de que quieres eliminar este pedido?')">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <br>
    </div>
</body>
</html>
