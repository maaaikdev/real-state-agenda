<?php
// Ruta del archivo JSON
$jsonFile = '../../data/data-form.json';

// Leer el contenido actual del archivo JSON
$data = file_get_contents($jsonFile);
$users = json_decode($data, true);

// Obtener el índice del registro a eliminar desde la solicitud AJAX
$request = json_decode(file_get_contents('php://input'), true);
$index = $request['index'];

// Verificar que el índice es válido
if (isset($users[$index])) {
    // Eliminar el registro del array
    array_splice($users, $index, 1);

    // Guardar el array actualizado en el archivo JSON
    file_put_contents($jsonFile, json_encode($users, JSON_PRETTY_PRINT));

    // Devolver una respuesta de éxito
    echo json_encode(['success' => true]);
} else {
    // Devolver una respuesta de error si no se encontró el índice
    echo json_encode(['success' => false]);
}
?>
