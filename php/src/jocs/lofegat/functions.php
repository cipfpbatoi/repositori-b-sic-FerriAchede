<?php

function createArrayLetters($wordGuess){
    for ($i=0; $i < strlen($wordGuess); $i++) { 
        $letters[$i] = "_";
    }
    return $letters;
}

function viewLetters($letters){
    echo "<br>";
    foreach ($letters as $letter => $value) {
        echo "$value ";
    }
}

function cleanInput($data) {
    $data = trim($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}

function isCorrectLetter($letter, $word){
    $wordArray = str_split($word);

    foreach ($wordArray as $wordA) {
        if ($wordA == $letter) {
            return true;
        }
    }
    return false;
}

// Devuelve la letra en su posición correcta [X => "x,X => "_",X => "x",X => "_",]
function putLetter($letters, $letter, $wordGuess){
    $wordGuessArray = str_split($wordGuess);
        for ($i=0; $i < strlen($wordGuess); $i++) { 
            if ($wordGuessArray[$i] == $letter) {
                $letters[$i] = $letter;
            }
        }
        return $letters;
}
function hasLostOrWon($letter, $letters){
    if ($_SESSION['mistakes'] == MAX_MISTAKES) {
        echo "<br><h3 class='incorrect'> Has perdido!</h3>";
        restartSession();
    }else if (implode("",$letters) == WORD_TO_GUESS){
        echo "<br><h3 class='correct'> Has ganado!</h3>";
        restartSession();
    }
}

function restartSession(){
    unset($_SESSION['word']);
    unset($_SESSION['letters']);
    unset($_SESSION['mistakes']);
}

?>