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

function putLetter($letters, $letter, $wordGuess){
    $wordGuessArray = str_split($wordGuess);
        for ($i=0; $i < strlen($wordGuess); $i++) { 
            if ($wordGuessArray[$i] == $letter) {
                $letters[$i] = $letter;
            }
        }
        return $letters;
}
?>