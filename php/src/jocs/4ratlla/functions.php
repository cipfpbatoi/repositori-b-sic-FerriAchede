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

function restartSession()
{
    unset($_SESSION['player']);
    unset($_SESSION['tableGame']);
    unset($_SESSION['mistakes']);
}

function hasLostOrWon($graella, $jugadorActual)
{
    // Comprobar filas (-)
    for ($i = 0; $i < ROWS; $i++) {
        for ($j = 0; $j < COLUMNS - 3; $j++) {
            if ($graella[$i][$j] == $jugadorActual &&
                $graella[$i][$j+1] == $jugadorActual &&
                $graella[$i][$j+2] == $jugadorActual &&
                $graella[$i][$j+3] == $jugadorActual) {
                return true;
            }
        }
    }

    // Comprobar columnas (|)
    for ($j = 0; $j < COLUMNS; $j++) {
        for ($i = 0; $i < ROWS - 3; $i++) {
            if ($graella[$i][$j] == $jugadorActual &&
                $graella[$i+1][$j] == $jugadorActual &&
                $graella[$i+2][$j] == $jugadorActual &&
                $graella[$i+3][$j] == $jugadorActual) {
                return true;
            }
        }
    }

    // Comprobar diagonales (\)
    for ($i = 3; $i < ROWS; $i++) {
        for ($j = 0; $j < COLUMNS - 3; $j++) {
            if ($graella[$i][$j] == $jugadorActual &&
                $graella[$i-1][$j+1] == $jugadorActual &&
                $graella[$i-2][$j+2] == $jugadorActual &&
                $graella[$i-3][$j+3] == $jugadorActual) {
                return true;
            }
        }
    }

    // Comprobar diagonales (/)
    for ($i = 0; $i < ROWS - 3; $i++) {
        for ($j = 0; $j < COLUMNS - 3; $j++) {
            if ($graella[$i][$j] == $jugadorActual &&
                $graella[$i+1][$j+1] == $jugadorActual &&
                $graella[$i+2][$j+2] == $jugadorActual &&
                $graella[$i+3][$j+3] == $jugadorActual) {
                return true;
            }
        }
    }

    return false;
}