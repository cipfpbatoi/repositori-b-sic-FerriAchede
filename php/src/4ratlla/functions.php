<?php
function inicialitzarGraella($rows, $columns){
    $graella = "";

    for ($i=0; $i < $rows; $i++) { 
        $graella .= "<tr>";
        for ($j=0; $j < $columns; $j++) { 
            $graella .= "<td class='buid'></td>";
        }
        $graella .= "</tr>";
    }
    return $graella;
}
?>