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

    $player = 1;
    $tableGame = inicialitzarGraella();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $position = $_POST['col'] - 1;

        if ($position >= COLUMNS || $position < 0) {
            echo "Introduzca una columna valida (1 - " . COLUMNS . ")";
        } else {
            ferMoviment($tableGame, $position, $player);
            $player = ($player == 1) ? 2 : 1;
        }
    }

    pintarGraella($tableGame);

    ?>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label for="col">Columna:</label>
            <input type="number" id="col" name="col" value="0" required min=1 max=7>
        </div>
        <div>
            <button type="submit">Enviar</button>
        </div>
    </form>

</body>

</html>