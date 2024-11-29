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
        <img style="position: absolute; left:39%; margin-top: -20px; width: 150px;" src="https://images.rappi.pe/restaurants_logo/a5cb83bc-fe90-421e-b7e2-9a020606bcdb-1618923957931.jpeg" ><br>

        <a href="nuevo.php" class="button">Agregar un nuevo cliente</a><br><br>
        <a href="../index.php" style="left: 12%; position:relative;">Volver</a>

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
    </div>
</body>
</html>