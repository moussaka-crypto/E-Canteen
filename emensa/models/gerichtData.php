<?php

function getGerichtData(){
    $link = connectdb();

    $sql = "SELECT * FROM gericht WHERE id = " . $_GET['gerichtID'] .";";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $data;
}

function collectLast30(){
    $link = connectdb();

    $sql = "SELECT * FROM bewertung WHERE gericht_id = " . $_GET['gerichtID'] ."
    ORDER BY bewertung_id DESC LIMIT 30;";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $data;
}