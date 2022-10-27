<?php

const GET_PARAM_SUCHEN = 'suche';

echo "<form method='get'>
<input type='text' name = 'suche' value = " . $_GET[GET_PARAM_SUCHEN]. ">
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
    $line = $line . trim (fgets($search_word,1024)).';';
}

$words = explode(";", $line);

for($find = 0; $find < count($words) - 1; $find += 2) {
    if ($words[$find] == $_GET[GET_PARAM_SUCHEN]) {
        echo $words[$find + 1];
        $exist = true;
    }
}
if(!$exist){
    echo "Das gesuchte Wort " . $_GET[GET_PARAM_SUCHEN] . " ist nicht enthalten";
}

fclose($search_word);
?>