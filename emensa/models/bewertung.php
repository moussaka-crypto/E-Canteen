<?php

function getBewertungData(){
    $link = connectdb();

    $sql = "SELECT * FROM ownreviews WHERE user='".$_SESSION["angemeldet"]."';";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $data;
}
function highlightbewertung(){
    $link = connectdb();

    $sql = "UPDATE bewertung 
            SET hervorgehoben = true
            WHERE bewertung_id = " . $_GET['bewertungID'] . ";";
    mysqli_query($link, $sql);

    /*
    $sql = "SELECT bewertung_id, hervorgehoben FROM bewertung WHERE gericht_id = '".$_SESSION['auswahl']."'ORDER BY bewertung_id DESC;";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    if(!empty($_POST['toHighlight'])) {
        foreach ($data as $check) {
            if(in_array($check['bewertung_id'],$_POST['toHighlight'])) {
                $sql = "UPDATE bewertung 
            SET hervorgehoben = true
            WHERE bewertung_id = " . $check['bewertung_id'] . ";";
                mysqli_query($link, $sql);
            }
            else{
                $sql = "UPDATE bewertung 
            SET hervorgehoben = false
            WHERE bewertung_id = " . $check['bewertung_id'] . ";";
                mysqli_query($link, $sql);
            }
        }
    }else {
        foreach ($data as $check) {
            $sql = "UPDATE bewertung 
            SET hervorgehoben = false
            WHERE bewertung_id = " . $check['bewertung_id'] . ";";
            mysqli_query($link, $sql);
        }
    }
    */
    mysqli_close($link);
}
function unhighlightBewertung(){
    $link = connectdb();

    $sql = "UPDATE bewertung 
            SET hervorgehoben = 0
            WHERE bewertung_id = " . $_GET['bewertungID'] . ";";
    mysqli_query($link, $sql);
    mysqli_close($link);
}
function deleteSelectedBewertungen(){
    $link = connectdb();

    $sql = "DELETE FROM bewertung WHERE bewertung_id = ".$_GET['bewertungID'].";";
    mysqli_query($link, $sql);
    /*
    if(!empty($_POST['toDelete'])) {
        foreach ($_POST['toDelete'] as $value_id) {
            $sql = "DELETE FROM bewertung WHERE bewertung_id = '$value_id';";
            mysqli_query($link, $sql);
        }
    }
    */
    mysqli_close($link);
}

function getallhighlighted(){
    $link = connectdb();

    $sql = "SELECT * FROM showreviews";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $data;
}


