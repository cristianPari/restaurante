<?php
require_once '../config/database.php';

function sanitizeInput($input)
{
    return htmlspecialchars(strip_tags(trim($input)));
}

function crearProducto($nombre, $precio, $descripcion, $categoria, $disponible){
    global $tasksCollection2;

    $resultado = $tasksCollection2->insertOne([
        'nombre' => sanitizeInput($nombre),
        'precio' => sanitizeInput($precio),
        'descripcion' => sanitizeInput($descripcion),
        'categoria' => sanitizeInput($categoria),
        'disponible' => false
    ]);
    
    return $resultado->getInsertedId();
}

function obtenerProducto()
{
    global $tasksCollection2;
    return $tasksCollection2->findOne();
}

function obtenerProductoPorId()
{
    global $tasksCollection2;
    return $tasksCollection2->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
}

function actualizarProducto($id, $nombre, $precio, $descripcion, $categoria, $disponible)
{
    global $tasksCollection2;

    $resultado = $tasksCollection2->updateOne(
        ['_id' => new MongoDB\BSON\ObjectId($id)],
        ['$set' => [
            'nombre' => sanitizeInput($nombre),
            'precio' => sanitizeInput($precio),
            'descripcion' => sanitizeInput($descripcion),
            'categoria' => sanitizeInput($categoria),
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

