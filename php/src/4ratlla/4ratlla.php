<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>4ratlla</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    
    <?php
    require 'functions.php';

    $tableGame = inicialitzarGraella();
    pintarGraella($tableGame);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $position = $_POST['pos'];
    }

    ?>

   
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label for="pos">Posición:</label>
            <input type="number" id="pos" name="pos" value="0" required min=1 max=7>
        </div>
        <div>
            <button type="submit">Enviar</button>
        </div>
    </form>

</body>

</html>