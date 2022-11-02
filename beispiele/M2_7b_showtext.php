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
$line = "";
$exist = false;

while(!feof($search_word)){
    $line = $line . trim(fgets($search_word,1024)).';';
}

$words = explode(";", $line);

for($find = 0; $find < count($words) - 1; $find++) {
    if (!is_null($suche) && $words[$find] == $suche) {

        if($find % 2 == 0)
            echo $words[$find+1];
        else
            echo $words[$find-1];

        $exist = true;
        break; // damit die Wörter, die gleich auf Deutsch und Englisch sind, nicht zweimal ausgegeben werden.
    }
}

if(!$exist && !is_null($suche)){
    echo "Das gesuchte Wort " . "<em>" . $_GET[GET_PARAM_SUCHEN] . "</em>". " ist nicht enthalten";
}

fclose($search_word);
