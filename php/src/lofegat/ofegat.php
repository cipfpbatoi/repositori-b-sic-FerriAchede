<?php
session_start();
require 'functions.php';
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

    <?php

    const WORD_TO_GUESS = "ofegat";
    const MAX_MISTAKES = 6;

    // Reiniciar el juego al pulsar "Reiniciar"
    if (isset($_POST['reset'])) {
        session_unset();
    }

    if (!isset($_SESSION['word'])) {
        $_SESSION['word'] = WORD_TO_GUESS;
        $_SESSION['letters'] = createArrayLetters(WORD_TO_GUESS);
        $_SESSION['mistakes'] = 0;
    }
    $letters = $_SESSION['letters'];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['reset'])) {
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
    viewLetters($letters);

    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label for="letra">Letra:</label>
            <input type="text" id="letra" name="letra" value="" required>
        </div>
        <div>
            <button type="submit">Enviar</button>
        </div>
    </form>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <button type="submit" name="reset">Reiniciar</button>
        </div>
    </form>
    <p>Fallos: <?= isset($mistakes) ? $mistakes : $_SESSION['mistakes'] ?></p>

</body>

</html>