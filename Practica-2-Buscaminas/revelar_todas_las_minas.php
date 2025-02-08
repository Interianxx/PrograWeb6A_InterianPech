<?php
// Establece el encabezado para indicar que la respuesta será en formato JSON.
header('Content-Type: application/json');

// Función para generar una matriz de minas (esto puede ser dinámico si fuera necesario).
function generarMinas() {
    // Aquí puedes añadir una lógica más compleja para generar minas aleatoriamente, 
    // por ahora es una simulación con algunas posiciones específicas.
    return [
        ['fila' => 1, 'columna' => 2], // Mina en la posición (1,2)
        ['fila' => 3, 'columna' => 5], // Mina en la posición (3,5)
        ['fila' => 6, 'columna' => 7]  // Mina en la posición (6,7)
    ];
}

// Obtener las minas generadas.
$minas = generarMinas();

// Responder con un objeto JSON que contiene la lista de minas.
echo json_encode([
    'status' => 'success',  // Estado de la respuesta
    'minas' => $minas      // La matriz de minas
]);
?>
