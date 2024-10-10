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
            $_SESSION['player'] = ($_SESSION['player'] == 1) ? 2 : 1;
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
    <link rel="stylesheet" href="styles.css">
</head>
<?php pintarGraella($_SESSION['tableGame']) ?>
<body>
    <?php if (!$boolWin): ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div>
                <label>Jugador <?= $_SESSION['player'] ?></label>
                <label for="col">Columna:</label>
                <input type="number" id="col" name="col" value="1" required min=1 max=7>
            </div>
            <div>
                <button type="submit">Enviar</button>
            </div>
        </form>
    <?php else: ?>
        <h3> Ha ganado el jugador <?= $_SESSION['player'] ?><h3>
            <?php endif; ?>
            <div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <button type="submit" name="reset">Reiniciar</button>
                </form>
                <a href="../index.php">Volver al inicio de sesión</a>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <button type="submit" name="logout">Logout</button>
                </form>
            </div>

</body>

</html>