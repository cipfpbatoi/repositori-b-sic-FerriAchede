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
    
        $frase = "Hola muy buenas.";
        echo "Frase: $frase <br>";
        echo "Hay " . contarVocales(strtolower($frase)) . " vocales.";

        function contarVocales($cadena){
            $vocales = ["a", "e", "i", "o", "u"];

            $cont = 0;
            for ($i=0; $i < strlen($cadena); $i++) { 
                for ($j=0; $j < count($vocales); $j++) { 
                    if ($cadena[$i] === $vocales[$j]) {
                        $cont++;
                    }
                }
            }
            return $cont;
        }
    
    ?>

</body>

</html>



