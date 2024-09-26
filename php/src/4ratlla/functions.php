<?php
const ROWS = 6;
const COLUMNS = 7;
const lastLine = "<tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>";
        
function inicialitzarGraella(){
    $table = [];
    for ($i=0; $i < ROWS; $i++) { 
        $table[$i][] = $i;
        for ($j=0; $j < COLUMNS; $j++) { 
            $table[$i][$j] = $j;
        }
    }
    return $table;
}

function pintarGraella($graella){
    echo "<table>";
    foreach ($graella as $number => $row) {
        echo "<tr>";
        foreach ($row as $num => $value) {
            echo "<td class='buid'></td>";
        }
        echo "</tr>";
    }

    for ($i=0; $i < 1; $i++) { 
        echo "<tr>";
        for ($j=0; $j < COLUMNS; $j++) { 
            echo "<td></td>";
        }
    }
    echo "</table>"; 
}


?>