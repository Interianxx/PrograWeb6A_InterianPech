<?php
echo "Bienvenido a Piedra, Papel, Tijera, Lagarto, Spock\n";

$opciones = ["piedra", "papel", "tijeras", "lagarto", "spock"];

// Reglas 
echo "Reglas del juego:\n";
echo "- Tijeras cortan Papel\n";
echo "- Papel tapa a Piedra\n";
echo "- Piedra aplasta a Lagarto\n";
echo "- Lagarto envenena a Spock\n";
echo "- Spock rompe Tijeras\n";
echo "- Tijeras decapitan Lagarto\n";
echo "- Lagarto devora Papel\n";
echo "- Papel desautoriza Spock\n";
echo "- Spock vaporiza Piedra\n";
echo "- Piedra aplasta Tijeras\n\n";

// Verificar que se hayan proporcionado dos argumentos
if ($argc != 3) {
    echo "Uso: php piedra_papel_tijera_lagarto_spock.php <mano1> <mano2>\n";
    echo "Opciones válidas: 0 (piedra), 1 (papel), 2 (tijeras), 3 (lagarto), 4 (spock)\n";
    exit(1);
}

// Obtener las elecciones de los jugadores
$mano1 = intval($argv[1]);
$mano2 = intval($argv[2]);

// Validar las elecciones
if ($mano1 < 0 || $mano1 >= count($opciones) || $mano2 < 0 || $mano2 >= count($opciones)) {
    echo "Opción no válida. Por favor, elige números entre 0 y " . (count($opciones) - 1) . ".\n";
    exit(1);
}

$manoJugador1 = $opciones[$mano1];
$manoJugador2 = $opciones[$mano2];

echo "Jugador 1 eligió: $manoJugador1\n";
echo "Jugador 2 eligió: $manoJugador2\n";

// Determinar el resultado
$reglas = [
    "tijeras" => ["papel", "lagarto"],
    "papel" => ["piedra", "spock"],
    "piedra" => ["lagarto", "tijeras"],
    "lagarto" => ["spock", "papel"],
    "spock" => ["tijeras", "piedra"]
];

if ($manoJugador1 == $manoJugador2) {
    echo "Empate\n";
} elseif (in_array($manoJugador2, $reglas[$manoJugador1])) {
    echo "Jugador 1 gana ($manoJugador1 le gana a $manoJugador2)\n";
} else {
    echo "Jugador 2 gana ($manoJugador2 le gana a $manoJugador1)\n";
}
?>