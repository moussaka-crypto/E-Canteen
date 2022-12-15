<?php

$name = "Elon Mess";
$email = "admin@emensa.example.com";
$passwort = "example";
$salt = "prefix";

$database_connect = mysqli_connect("localhost", // Host der Datenbank
    "root",                 // Benutzername zur Anmeldung
    "root",                 // Passwort
    "emensawerbeseite",     // Auswahl der Datenbanken (bzw. des Schemas)
    3306 // optional port der Datenbank
);

if (!$database_connect) {
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}

$default = 0;

$sql_abfrage_1 = "INSERT INTO benutzer (name, admin, email, passwort,anzahlAnmeldungen,letzteAnmeldung) VALUES (".
    "'".$name."',
    ". true .",
    '".$email."',
    '" .sha1($salt . $passwort)."',
    '".$default."',
    '". date("d.m.y")."')";

$passSql_1 = mysqli_query($database_connect,$sql_abfrage_1);
