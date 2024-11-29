<?php
require_once '../config/database.php';

function sanitizeInput($input)
{
    return htmlspecialchars(strip_tags(trim($input)));
}

function crearProducto($nombre, $precio, $descripcion, $categoria){
    global $tasksCollection2;

    $resultado = $tasksCollection2->insertOne([
        'nombre' => sanitizeInput($nombre),
        'precio' => sanitizeInput($precio),
        'descripcion' => sanitizeInput($descripcion),
        'categoria' => sanitizeInput($categoria),
        'disponible' => true
    ]);
    
    return $resultado->getInsertedId();
}

function obtenerProducto()
{
    global $tasksCollection2;
    $cursor = $tasksCollection2->find();
    $productos = [];
    foreach ($cursor as $documento) {
        $productos[] = (array)$documento;
    }
    return $productos;
}


function obtenerProductoPorId($id)
{
    global $tasksCollection2;
    return $tasksCollection2->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
}

function actualizarProducto($id, $nombre, $precio, $categoria, $descripcion, $disponible)
{
    global $tasksCollection2;

    $resultado = $tasksCollection2->updateOne(
        ['_id' => new MongoDB\BSON\ObjectId($id)],
        ['$set' => [
            'nombre' => sanitizeInput($nombre),
            'precio' => sanitizeInput($precio),
            'categoria' => sanitizeInput($categoria),
            'descripcion' => sanitizeInput($descripcion),
            'disponible' => (bool)$disponible
        ]]
    );
    return $resultado->getModifiedCount();
}

function eliminarProducto($id)
{
    global $tasksCollection2;
    $resultado = $tasksCollection2->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    return $resultado->getDeletedCount();
}

function toggleProductoDisponible($id) {
    global $tasksCollection2;
    try {
        $producto = $tasksCollection2->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
        if ($producto) {
            $nuevoEstado = !$producto['disponible'];
            $tasksCollection2->updateOne(
                ['_id' => new MongoDB\BSON\ObjectId($id)],
                ['$set' => ['disponible' => $nuevoEstado]]
            );
            return $nuevoEstado;
        }
    } catch (Exception $e) {
        error_log("Error en toggleProductoDisponible: " . $e->getMessage());
        return null;
    }
    return null;
}

