<?php
session_start();
require 'functions.php';

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    if (isset($_COOKIE['username'])) {
        setcookie("username", "", time() - 3600, "../");
    }
    header("Location: ../index.php");
    exit();
}

if (isset($_SESSION['user'])) {
    echo "Usuario: " . htmlspecialchars($_SESSION['user']) . "<br>";
} else {
    header("Location: ../index.php");
    exit();
}

if (isset($_POST['reset'])) {
    restartSession();
    $_SESSION['tableGame'] = inicialitzarGraella();
}

// Inicializa el jugador
if (!isset($_SESSION['player'])) {
    $_SESSION['player'] = 1;
}

//Inicializa la tabla
if (!isset($_SESSION['tableGame'])) {
    $_SESSION['tableGame'] = inicialitzarGraella();
}

if (!isset($boolWin)) {
    $boolWin = false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['reset']) && !isset($_POST['logout'])) {
    if (!$boolWin) {
        $position = $_POST['col'] - 1;

        if ($position >= COLUMNS || $position < 0) {
            echo "Introduzca una columna valida (1 - " . COLUMNS . ")";
        } else {
            ferMoviment($_SESSION['tableGame'], $position, $_SESSION['player']);
            $boolWin = hasLostOrWon($_SESSION['tableGame'], $_SESSION['player']);
            if (!$boolWin) {
                $_SESSION['player'] = ($_SESSION['player'] == 1) ? 2 : 1;
            }
        }
    }
}


?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>4ratlla</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
</head>

<body>
    <h1>4 en Ratlla</h1>
    <main class="graella">
        <?php pintarGraella($_SESSION['tableGame']) ?>

        <?php if (!$boolWin): ?>
            <tr>
                <?php
                for ($j = 0; $j < COLUMNS; $j++) {
                    $buttonValue = $j + 1;
                    echo "<td>";
                    echo "<form method='POST' action=''>";
                    echo "<button type='submit' name='col' value='$buttonValue'>$buttonValue</button>";
                    echo "</form>";
                    echo "</td>";
                }
                ?>
            </tr>

        <?php else: ?>
            <caption> <strong>Ha ganado el jugador <?= $_SESSION['player'] ?></strong><caption>
                <?php endif; ?>
                </table>
    </main>
    <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <button type="submit" name="reset">Reiniciar</button>
            <button type="submit" name="logout">Logout</button><br>
        </form>
        <a href="../index.php">Volver al inicio de sesión</a>
    </div>

</body>

</html>