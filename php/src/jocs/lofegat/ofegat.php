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
}

const WORD_TO_GUESS = "ofegat";
const MAX_MISTAKES = 6;

if (!isset($_SESSION['word'])) {
    $_SESSION['word'] = WORD_TO_GUESS;
    $_SESSION['letters'] = createArrayLetters(WORD_TO_GUESS);
    $_SESSION['mistakes'] = 0;
}
$letters = $_SESSION['letters'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['reset']) && !isset($_POST['logout'])) {
    $letter = cleanInput(substr($_POST['letra'], 0, 1)); // Limpia el input y lo guarda con solo una letra.

    if (!isCorrectLetter($letter, WORD_TO_GUESS)) {
        $_SESSION['mistakes'] += 1;
        echo "<span class='incorrect'>La letra $letter no forma parte de la palabra</span>";
    } else {
        echo "<span class='correct'>$letter Es correcto!</span>";
        $_SESSION['letters'] = putLetter($letters, $letter, WORD_TO_GUESS);
        $letters = $_SESSION['letters'];
    }
    $mistakes = $_SESSION['mistakes'];
    hasLostOrWon($letter, $letters);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>L'Ofegat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1>L'Ofegat</h1>
        <?= viewLetters($letters); ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label for="letra">Letra:</label>
                <input type="text" id="letra" name="letra" value="" required>
            </div>
            <div>
                <button type="submit">Enviar</button>
            </div>
        </form>
        <p>Fallos: <?= isset($mistakes) ? $mistakes : $_SESSION['mistakes'] ?> de <?= MAX_MISTAKES ?></p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <button type="submit" name="reset">Reiniciar</button>
                <button type="submit" name="logout">Logout</button>
            </div>
        </form>
        <a href="../index.php">Volver al inicio de sesión</a>
            
        </form>
</body>

</html>