<?php

$access_log = fopen('accesslog.txt','a');

if(!$access_log){
    die("Fehler beim Öffnen");
}

$ip_server = $_SERVER['REMOTE_ADDR'];
$browser=$_SERVER['HTTP_USER_AGENT'];

fwrite($access_log,date("d.m.Y  H:i") ."\n".
    "IP: ". $ip_server ."\n".
    "Web Browser: ".$browser. "\n" );
fclose($access_log);

