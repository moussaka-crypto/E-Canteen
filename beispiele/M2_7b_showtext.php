<?php
/**
 * Praktikum DBWT. Autoren:
 * Hristomir, Dimov, 3536320
 * Muhammad Zulfahmi, bin Zaid, 3520750
 */

const GET_PARAM_SUCHEN = 'suche';
$suche = $_GET[GET_PARAM_SUCHEN] ?? null;

echo "<form method='get'>
<input type='text' name = 'suche' value = " . $suche ." >
<input type='submit' value='SEARCH'>
</form> ";

$search_word = fopen('en.txt','r');

if(!$search_word){
    die("Fehler beim Öffnen");
}
$words = [];
$line = [];
$exist = false;

while(!feof($search_word)){
    $line [] = explode(";", trim(fgets($search_word,1024)));
}

if(!is_null($suche)) {
    for ($tupel = 0; $tupel < count($line); $tupel++) {
        if ($suche == $line[$tupel][0]){
            echo $line[$tupel][1];
            $exist = true;
            break;
        }
        else if($suche == $line[$tupel][1]){
            echo $line[$tupel][0];
            $exist = true;
        }

    }
}

if(!$exist && !is_null($suche)){
    echo "<p>Das gesuchte Wort<em> " . $suche . " </em>ist nicht enthalten</p>";
}
fclose($search_word);
