<?php
const ROWS = 6;
const COLUMNS = 7;

function inicialitzarGraella()
{
    $table = [];
    for ($i = 0; $i < ROWS; $i++) {
        $table[$i][] = $i;
        for ($j = 0; $j < COLUMNS; $j++) {
            $table[$i][$j] = null;
        }
    }
    return $table;
}

function pintarGraella($graella)
{
    //Pinta la tabla
    echo "<table>";
    foreach ($graella as $number => $row) {
        echo "<tr>";
        foreach ($row as $num => $value) {
            if ($value == 1) {
                echo "<td class='player1'></td>";
            } else if ($value == 2) {
                echo "<td class='player2'></td>";
            } else {
                echo "<td class='buid'></td>";
            }
        }
        echo "</tr>";
    }

    //Pinta la ultima linea
    for ($i = 0; $i < 1; $i++) {
        echo "<tr>";
        for ($j = 0; $j < COLUMNS; $j++) {
            echo "<td></td>";
        }
    }
    echo "</table>";
}

function ferMoviment(&$graella, $columna, $jugadorActual)
{
    //Recorre de abajo arriba hasta encontrar un hueco para pintar
    for ($i = ROWS - 1; $i >= 0; $i--) {
        if ($graella[$i][$columna] === null) {
            $graella[$i][$columna] = $jugadorActual;
            return;
        }
    }
    echo "La columna está llena.";
}
