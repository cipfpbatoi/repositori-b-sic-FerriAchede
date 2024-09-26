<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>L'Ofegat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <table>
	<tbody>
    <?php
    require 'functions.php';

    const ROWS = 6;
    const COLUMNS = 7;

    echo inicialitzarGraella(ROWS,COLUMNS);

    ?>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label for="numero">Letra:</label>
            <input type="number" id="numero" name="numero" value="0" required min=1 max=7>
        </div>
        <div>
            <button type="submit">Enviar</button>
        </div>
    </form>

</body>

</html>