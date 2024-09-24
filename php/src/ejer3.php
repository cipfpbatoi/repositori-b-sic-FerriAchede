<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>HTML</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="estilo.css">
</head>

<body>
    <?php
        
        $notas = [5, 10, 7, 8, 3];
        mostrarMediana($notas);

        function mostrarMediana($array){
            echo "Notas: ";
            foreach ($array as $notas) {
                echo "$notas ";
            }
                echo "<br>";

            $sumNotas = 0;
            foreach ($array as $nota) {
                $sumNotas += $nota;
            }

            $sumNotas = $sumNotas / count($array);
            echo "Media: $sumNotas";
        }
    ?>
</body>

</html>



