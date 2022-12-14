<?php
function check_anmeldeDaten(){
    $logger = logger();

    $benutzername = $_POST["benutzer_name"];
    $email = $_POST["email"];
    $passwort = sha1("prefix". $_POST["passwort"]);

    $link = connectdb();

    //1.9
    mysqli_begin_transaction($link);
    $sql_id = "SELECT * FROM benutzer WHERE email = '$email';";
    $check_id = mysqli_query($link, $sql_id);
    $result_check_id = mysqli_fetch_assoc($check_id);

    $id_to_update = $result_check_id['id'];
    $date_to_update = date("Y-m-d H:i:s");

    $sql_fehler = "UPDATE benutzer
    SET letzterfehler = '$date_to_update'
    WHERE id = ".$id_to_update.";";


    if(is_null($result_check_id['id'])){  //entsprechende Fehlermeldung
        $logger->warning("Keine Anmeldedaten");
        return "Keine Anmeldedaten ):";
    }
    elseif ($result_check_id['name'] != $benutzername){
        mysqli_query($link,$sql_fehler);
        mysqli_commit($link);
        $logger->warning("Falscher Benutzername");
        return "Falscher Benutzername ):";
    }
    elseif($result_check_id['passwort'] != $passwort) {
        mysqli_query($link,$sql_fehler);
        mysqli_commit($link);
        $logger->warning("Falsches Passwort");
        return  "Falsches Passwort ):";
    }
    //1.5
    $update_anmeldungzahl = "CALL anmeldungInkrementieren(".$id_to_update.",'$email');";
    mysqli_query($link,$update_anmeldungzahl);

    //1.6
    $update_date = "UPDATE benutzer 
    SET letzteanmeldung = '$date_to_update'
    WHERE id = ".$id_to_update.";";
    mysqli_query($link, $update_date);
    mysqli_commit($link); //1.9 end


    mysqli_close($link);
    $_SESSION['angemeldet'] = $result_check_id['name'];
    $logger->info("$benutzername ist erfolgreich angemeldet.");
    return "Erfolgreich angemeldet (:";
}
