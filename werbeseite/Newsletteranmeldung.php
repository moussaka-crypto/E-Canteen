<?php
include 'index.html';

const POST_PARAM_VNAME = 'vorname';
const POST_PARAM_EMAIL = 'email';
const POST_PARAM_NEWS = 'newsletterSprache';
const POST_PARAM_DATEN = 'datenschutz';

$data= [];
$valid = true;
$fehler_name = '';
$fehler_email = '';

if(isset($_POST[POST_PARAM_VNAME])){
    $check_name = trim($_POST[POST_PARAM_VNAME]);
    if(!ctype_alpha($check_name)) {
        $valid = false;
    }

    if($valid){
        $data [] = $_POST[POST_PARAM_VNAME];
        unset($fehler_name);
    }
    else{
        $fehler_name = "Namen entspricht nicht der Vorgaben";
    }
}
else{
    $valid = false;
    $fehler_name = "Namen entspricht nicht der Vorgaben";
}


if(isset($_POST[POST_PARAM_EMAIL])){
    $check_email = $_POST[POST_PARAM_EMAIL];
    if(!filter_var($check_email,FILTER_VALIDATE_EMAIL)){
        $valid = false;
    }
    $forbidden_email = false;

    $forbidden_email = strpos($check_email, "rcpt.at");
    $forbidden_email = strpos($check_email, "damnthespam.at");
    $forbidden_email = strpos($check_email, "wegwerfmail.de");
    $forbidden_email = strpos($check_email, "trashmail.de");
    $forbidden_email = strpos($check_email, "trashmail.com");


    if($valid && !$forbidden_email){
        $data [] = $_POST[POST_PARAM_EMAIL];
        unset($fehler_email);
    }
    else {
        $valid = false;
        $fehler_email = "Email entspricht nicht der Vorgaben";
    }
}

if(isset($_POST[POST_PARAM_NEWS])){
    if($valid){
        $data [] = $_POST[POST_PARAM_NEWS];
    }
}
 if(isset($_POST[POST_PARAM_DATEN])){
     if($valid){
         $data [] = 'true';
     }
 }

 if($valid){
     $data_file = fopen('Benutzerdaten.txt', 'a');
     $benutzer_daten = $data[0].';'.$data[1].';'.$data[2].';'.$data[3]."\n";
     fwrite($data_file,$benutzer_daten);
     fclose($data_file);
 }
else
{
    unset($data);
}


