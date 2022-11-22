<?php
/**
 * Praktikum DBWT. Autoren:
 * Hristomir, Dimov, 3536320
 * Muhammad Zulfahmi, bin Zaid, 3520750
 */
$database_connect = mysqli_connect("localhost", // Host der Datenbank
    "root",                 // Benutzername zur Anmeldung
    "root",    // Passwort
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
    isset($_POST["email"])&&
    isset($_POST["ersteller"]))
{
    $gerichtName = '\''.$_POST["gericht"].'\'';
    $beschreibung = '\''.$_POST["beschreibung"].'\'';
    $email = '\''.$_POST["email"].'\'';
    $ersteller = '\''.$_POST["ersteller"].'\'';

    // SQL-Injection my ass
    $gerichtName = mysqli_real_escape_string($database_connect, $gerichtName);
    $beschreibung = mysqli_real_escape_string($database_connect, $beschreibung);
    $email = mysqli_real_escape_string($database_connect, $email);
    $ersteller = mysqli_real_escape_string($database_connect, $ersteller);

    $db_ersteller = "INSERT INTO emensawerbeseite.ersteller (Name, EMail) VALUES ('$ersteller', '$email');";
    $db_gerichtDaten = "INSERT INTO emensawerbeseite.wunschgericht (Name, Beschreibung, ID_Ersteller, Erstellungsdatum)
    VALUES ('$gerichtName', '$beschreibung', (SELECT MAX(ID) FROM emensawerbeseite.ersteller), $datum);";
}
else if(isset($_POST["gericht"])&&
    isset($_POST["beschreibung"])&&
    isset($_POST["email"]))
{
    $gerichtName = '\''.$_POST["gericht"].'\'';
    $beschreibung = '\''.$_POST["beschreibung"].'\'';
    $email = '\''.$_POST["email"].'\'';

    // SQL-Injection my ass
    $gerichtName = mysqli_real_escape_string($database_connect, $gerichtName);
    $beschreibung = mysqli_real_escape_string($database_connect, $beschreibung);
    $email = mysqli_real_escape_string($database_connect, $email);

    $db_ersteller = "INSERT INTO emensawerbeseite.ersteller (Name, EMail) VALUES ('$email');";
    $db_gerichtDaten = "INSERT INTO emensawerbeseite.wunschgericht (Name, Beschreibung, ID_Ersteller, Erstellungsdatum)
    VALUES ('$gerichtName', '$beschreibung', (SELECT MAX(ID) FROM emensawerbeseite.ersteller), $datum);";
}

if(isset($db_gerichtDaten) && isset($db_ersteller))
{
    $erstellerQueryResult = mysqli_query($database_connect,$db_ersteller);
    if(!$erstellerQueryResult) {
        echo "Error during Query: ", mysqli_error($database_connect);
        exit();
    }

    $gerichtDatenQueryResult = mysqli_query($database_connect, $db_gerichtDaten);
    if(!$gerichtDatenQueryResult){
        echo "Error during Query: ", mysqli_error($database_connect);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Eingabeformular</title>
</head>
<style>
    fieldset{
        width: 350px;
    }
    input{
        margin-bottom: 7px;
    }
</style>
<body>
<form action="<?php echo $_SERVER["PHP_SELF"]; // A1 4)?>" method = "post">
    <fieldset>
        <legend><em>Eingabeformular für Ihr Wunschgericht</em></legend>
        <label for="gericht">Name*</label>
        <br>
        <input type="text" size="33" placeholder="Namen des Gerichts eingeben" id="gericht" name="gericht" required>
        <br>
        <label for="beschreibung">Beschreibung*</label>
        <br>
        <input type = "text" size="33" placeholder="Beschreibung des Gerichts eingeben" id="beschreibung" name="beschreibung" required>
        <br>
        <label for="email">E-Mail*</label>
        <br>
        <input type = "email" size="33" placeholder="E-Mail eingeben" id="email" name="email" required>
        <br>
        <label for="ersteller">Ihr Name*</label>
        <br>
        <input type="text" size="33" placeholder="Ihren Namen eingeben" id="ersteller" name="ersteller" required>
        <br><br>
        <input type="submit" value="Wunsch abschicken">
        <br>
    </fieldset>
</form>
</body>
</html>
