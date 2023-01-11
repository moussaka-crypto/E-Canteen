<?php

function getGerichtData(){
    $link = connectdb();

    $gerichtID = $_GET['gerichtID'] ?? null;

    if(empty($gerichtID)) {
        echo "gibt bitte die parameter gerichtID einen Wert";
        exit();
    }
    $sql = "SELECT * FROM gericht WHERE id = '$gerichtID' ;";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $data;
}

function collectLast30(){
    $link = connectdb();

    $sql = "SELECT * FROM showlast30 WHERE gerichtID = " . $_GET['gerichtID'] ."
    ORDER BY bewertung_id DESC LIMIT 30;";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $data;
}