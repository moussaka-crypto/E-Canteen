<?php
function check_anmeldeDaten(){
    $logger = logger();

    $benutzername = $_POST["benutzer_name"];
    $email = $_POST["email"];
    $passwort = sha1("prefix". $_POST["passwort"]);

    $link = connectdb();

    mysqli_begin_transaction($link);
    $sql_id = "SELECT * FROM benutzer WHERE email = '$email';";
    $check_id = mysqli_query($link, $sql_id);
    $result_check_id = mysqli_fetch_assoc($check_id);

    $id_to_update = $result_check_id['id'];
    $date_to_update = date("Y-m-d H:i:s");

    $sql_fehler = "UPDATE benutzer
    SET letzterfehler = '$date_to_update'
    WHERE id = ".$id_to_update.";";


    if(is_null($result_check_id['id'])){
        $logger->warning("keine Anmeldedaten unter dieser Email");
        return "keine Anmeldedaten unter dieser Email";
    }elseif ($result_check_id['name'] != $benutzername){
        mysqli_query($link,$sql_fehler);
        mysqli_commit($link);
        $logger->warning("falsche Benutzername");
        return "falscher Benutzername";
    }elseif($result_check_id['passwort'] != $passwort) {
        mysqli_query($link,$sql_fehler);
        mysqli_commit($link);
        $logger->warning("falsches Passwort");
        return  "falsches Passwort";
    }

    $update_date = "UPDATE benutzer
    SET letzteanmeldung = '$date_to_update'
    WHERE id = ".$id_to_update.";";
    mysqli_query($link, $update_date);
    mysqli_commit($link);

    $update_anmeldungzahl = "CALL anmeldungInkrementieren(".$id_to_update.",'$email');";
    mysqli_query($link,$update_anmeldungzahl);

    mysqli_close($link);
    $_SESSION['angemeldet'] = $result_check_id['name'];
    $_SESSION['admin'] = $result_check_id['admin'];
    $_SESSION['benutzerID'] = $result_check_id['id'];
    $logger->info("$benutzername ist erfolgreich angemeldet");
    return "Erfolgreich angemeldet";
}

function save_bewertung(){
    $benutzerID = $_SESSION["benutzerID"];
    $description = $_POST["kommentare"];
    $stern = $_POST["sterne"];
    $date = date("Y-m-d H:i:s");
    $gerichtID = $_SESSION["auswahl"];

    $link = connectdb();
    $sql_id = "INSERT INTO bewertung (benutzer_id, gericht_id, description, stern, datum) 
VALUES ('$benutzerID','$gerichtID','$description','$stern','$date')";
    mysqli_query($link, $sql_id);
}


