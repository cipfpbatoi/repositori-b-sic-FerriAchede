<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>HTML</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="estilo.css">
  <style>
    table {
        width: 15%;
    }

    table, th, td {
        border: 1px solid black;
    }

    th, td {
        padding: 3px;
        text-align: center;
    }


  </style>
</head>

<body>
    <table>
    <?php
        
        $tablasMult = [];
        for ($i=1; $i <= 5; $i++) { 
            for ($j=1; $j <= 5; $j++) { 
                $tablasMult[$i][$j] = $i * $j;
            }
        }
        
        foreach ($tablasMult as $fila) {
            echo "<tr>";
            foreach ($fila as $celda) {
                echo "<td> $celda </td>"; 
            }
            echo "</tr>";
        }
    ?>
    </table>
</body>

</html>



