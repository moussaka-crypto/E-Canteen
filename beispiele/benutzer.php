<?php

$name = "Robby";
$email = "Robby@food.com";
$passwort = "eat";
$salt = "prefix";

$database_connect = mysqli_connect("localhost", // Host der Datenbank
    "root",                 // Benutzername zur Anmeldung
    "dbwt",    // Passwort
    "emensawerbeseite",     // Auswahl der Datenbanken (bzw. des Schemas)
    3306 // optional port der Datenbank
);

if (!$database_connect) {
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}


$sql_abfrage_1 = "INSERT INTO benutzer (name, admin, email, passwort,letzteanmeldung) VALUES (".
    "'".$name."',". 0 .",'".$email."','" .sha1($salt . $passwort)."','".
    date("d.m.y")."');";

$passSql_1 = mysqli_query($database_connect,$sql_abfrage_1);