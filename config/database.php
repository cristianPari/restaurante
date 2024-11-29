<?php
require_once __DIR__ . '/../vendor/autoload.php';

$mongoClient = new MongoDB\Client("mongodb+srv://cristian:dvWncE4mougR6KAw@cluster0.nn6qt.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0");
$database = $mongoClient->selectDatabase('restaurante');
$tasksCollection = $database->clientes;
$tasksCollection2 = $database->productos;
