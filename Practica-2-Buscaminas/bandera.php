<?php
// Inicia la sesión para poder almacenar información persistente entre peticiones.
session_start();

$data = json_decode(file_get_contents('php://input'), true);

$fila = $data['fila'];
$columna = $data['columna'];

if (!isset($_SESSION['banderas'])) {
    $_SESSION['banderas'] = [];
}

$key = "$fila-$columna";


if (isset($_SESSION['banderas'][$key])) {
    // Si la celda tiene bandera, la elimina.
    unset($_SESSION['banderas'][$key]);
    // Indicamos que la bandera ha sido eliminada.
    $marcada = false;
} else {
    // Si no tiene bandera, la agregamos a la variable de sesión.
    $_SESSION['banderas'][$key] = true;
    // Indicamos que la bandera ha sido colocada.
    $marcada = true;
}

// Devuelve una respuesta en formato JSON indicando si la celda está marcada o no.
echo json_encode(['marcada' => $marcada]);
?>
