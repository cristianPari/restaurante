<?php
require_once __DIR__ . '/funciones.php';

if (isset($_GET['accion']) && isset($_GET['id'])) {
    switch ($_GET['accion']) {
        case 'eliminar' :
            $count = eliminarCliente($_GET['id']);
            $mensaje = $count > 0 ? "Cliente eliminado con exito." : "No se pudo eliminar el ciente.";
            break;
    }
}

$clientes = obtenerCliente();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de clientes</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Lista de clientes</h1>
        <a href="nuevo.php" class="button">Agregar un nuevo cliente</a>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Direccion</th>
            </tr>
            <?php foreach ($clientes as $cliente): ?>
            <tr>
                <td><?php echo htmlspecialchars($cliente['nombre']); ?></td>
                <td><?php echo htmlspecialchars($cliente['correo']); ?></td>
                <td><?php echo htmlspecialchars($cliente['telefono']); ?></td>
                <td><?php echo htmlspecialchars($cliente['direccion']); ?></td>
                <td class="actions">
                    <a href="editar.php?id=<?php echo $cliente['_id']; ?>" class="button">Editar</a>
                    <a href="index.php?accion=eliminar&id=<?php echo $cliente['_id']; ?>" class="button" onclick="return confirm('¿Estas seguro de eliminar al cliente seleccionado?')">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>      
        </table>
        <a href="../index.php" class="button">Volver</a>
    </div>
</body>
</html>