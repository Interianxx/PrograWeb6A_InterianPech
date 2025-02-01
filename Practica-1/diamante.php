<?php 

function imprimirDiamante($tamano) {
    // Validar que el tamaño sea un número positivo
    if (!is_numeric($tamano) || $tamano <= 0) {
        echo "El tamaño debe ser un número positivo." . PHP_EOL;
        return;
    }

    // Parte superior del diamante
    for ($i = 1; $i <= $tamano; $i++) {
        // Imprimir espacios en blanco para la alineación
        echo str_repeat(" ", $tamano - $i);

        // Imprimir asteriscos para la parte superior del diamante
        echo str_repeat("* ", $i) . PHP_EOL;
    }

    // Parte inferior del diamante
    for ($i = $tamano - 1; $i >= 1; $i--) {
        // Imprimir espacios en blanco para la alineación
        echo str_repeat(" ", $tamano - $i);

        // Imprimir asteriscos para la parte inferior del diamante
        echo str_repeat("* ", $i) . PHP_EOL;
    }
}

// Verificar si se proporcionó un argumento
if (isset($argv[1])) {
    // Obtener el número ingresado como argumento
    $tamano = intval($argv[1]);

    // Llamar a la función para imprimir el diamante
    imprimirDiamante($tamano);
} else {
    echo "Por favor proporciona un argumento." . PHP_EOL;
}
?>
