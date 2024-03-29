<?php
/**
 * Praktikum DBWT. Autoren:
 * Hristomir, Dimov, 3536320
 * Muhammad Zulfahmi, bin Zaid, 3520750
 */
$database_connect = mysqli_connect("localhost", // Host der Datenbank
    "root",                 // Benutzername zur Anmeldung
    "dbwt",    // Passwort
    "emensawerbeseite",     // Auswahl der Datenbanken (bzw. des Schemas)
    3306 // optional port der Datenbank
);

$datum = '\''.date("d.m.y").'\'';

if (!$database_connect) {
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}

if(isset($_POST["gericht"])&&
    isset($_POST["beschreibung"])&&
    isset($_POST["email"]))
{

    $gerichtName = '\''.$_POST["gericht"].'\'';
    $beschreibung = '\''.$_POST["beschreibung"].'\'';
    $email = '\''.$_POST["email"].'\'';
    $ersteller = (!empty($_POST["ersteller"])) ? '\''.$_POST["ersteller"].'\'': 'anonym';

    /*
    $gerichtName = $_POST["gericht"];
    $beschreibung = $_POST["beschreibung"];
    $email = $_POST["email"];
    $ersteller = (!empty($_POST["ersteller"])) ? $_POST["ersteller"] : 'anonym';
    */

    $gerichtName = htmlspecialchars($gerichtName);
    $beschreibung = htmlspecialchars($beschreibung);
    $email = htmlspecialchars($email);
    $ersteller = htmlspecialchars($ersteller);

    // SQL-Injection my ass
    $gerichtName = mysqli_real_escape_string($database_connect, $gerichtName);
    $beschreibung = mysqli_real_escape_string($database_connect, $beschreibung);
    $email = mysqli_real_escape_string($database_connect, $email);
    $ersteller = mysqli_real_escape_string($database_connect, $ersteller);

    $check_email = "SELECT id FROM ersteller WHERE email = "."'".$email."'".";";
    $ask_email = mysqli_query($database_connect,$check_email);
    $collected_data = mysqli_fetch_assoc($ask_email);

    if (is_null($collected_data['id'])) {
        $db_new_ersteller = "INSERT INTO emensawerbeseite.ersteller (Name, EMail) VALUES ('$ersteller', '$email');";
        $db_gerichtDaten = "INSERT INTO emensawerbeseite.wunschgericht (Name, Beschreibung, ersteller_id, Erstellungsdatum)
    VALUES ('$gerichtName', '$beschreibung', (SELECT MAX(ID) FROM emensawerbeseite.ersteller), $datum);";

        $erstellerQueryResult = mysqli_query($database_connect, $db_new_ersteller);
        if (!$erstellerQueryResult) {
            echo "Error during Query: ", mysqli_error($database_connect);
            exit();
        }
    }else {
        $same_id = $collected_data['id'];
        $db_gerichtDaten = "INSERT INTO emensawerbeseite.wunschgericht (Name, Beschreibung, ersteller_id, Erstellungsdatum)
VALUES ('$gerichtName', '$beschreibung','$same_id', $datum);";

    }
    $gerichtDatenQueryResult = mysqli_query($database_connect, $db_gerichtDaten);
    if (!$gerichtDatenQueryResult) {
        echo "Error during Query: ", mysqli_error($database_connect);
        exit();
    }
    header('location:wunschgericht.php');
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Eingabeformular</title>
    <link rel="stylesheet" href="form_wunschgericht_styles.css">
</head>
<body>
<form method = "post">
    <fieldset>
        <legend><em>Eingabeformular für Ihr Wunschgericht</em></legend>
        <label for="gericht">Name*</label>
        <br>
        <input type="text" size="33" placeholder="Namen des Gerichts eingeben" id="gericht" name="gericht" required>
        <br>
        <label for="beschreibung">Beschreibung*</label>
        <br>
        <textarea id="beschreibung" name="beschreibung" rows="5" cols="300">"Beschreibung des Gerichts eingeben"</textarea>
        <br>
        <label for="email">E-Mail*</label>
        <br>
        <input type = "email" size="33" placeholder="E-Mail eingeben" id="email" name="email" required>
        <br>
        <label for="ersteller">Ihr Name*</label>
        <br>
        <input type="text" size="33" placeholder="Ihren Namen eingeben" id="ersteller" name="ersteller">
        <br><br>
        <input type="submit" value="Wunsch abschicken">
        <br>
    </fieldset>
</form>
<button><a href="werbeseite.php">Zurück</a></button>
</body>
</html>
