<?php

$access_log = fopen('accesslog.txt','a');

if(!$access_log){
    die("Fehler beim Öffnen");
}

$ip_server = $_SERVER['REMOTE_ADDR'];
fwrite($access_log,date("d.m.Y  H:i") . " IP: ". $ip_server . "\n" );
fclose($access_log);

