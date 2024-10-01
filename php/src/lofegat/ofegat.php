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

    if (!isset($_SESSION['word'])) {
        $_SESSION['word'] = WORD_TO_GUESS;
        $_SESSION['letters'] = createArrayLetters(WORD_TO_GUESS);
        $_SESSION['mistakes'] = 0;
    }
    $letters = $_SESSION['letters'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $letter = cleanInput(substr($_POST['letra'], 0, 1)); // Limpia el input y lo guarda con solo una letra.

        if (!isCorrectLetter($letter, WORD_TO_GUESS)) {
            echo "<span class='incorrect'>La letra $letter no forma parte de la palabra</span>";
            $_SESSION['mistakes'] += 1;
        } else {
            echo "<span class='correct'>$letter Es correcto!</span>";
            $_SESSION['letters'] = putLetter($letters, $letter, WORD_TO_GUESS);
            $letters = $_SESSION['letters'];
        }
        
        
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
    <p>Fallos: <?= $_SESSION['mistakes'] ?></p>

</body>

</html>