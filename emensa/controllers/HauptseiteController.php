<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/erste_5_gerichte.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/verification.php');

class HauptseiteController
{
    public function call_hauptseite(RequestData $rd)
    {
        $erste_5 = collect_first_5();
        $gericht_details = db_5_gericht();
        $allergen_details = db_code_allergen();
        $ga_details = db_gericht_allergen();
        $logger = logger();
        $logger->info("Zugriff auf der Hauptseite");

        return view('hauptseite.display_hauptseite', [
            'request' => $rd,
            'erste_5' => $erste_5,
            'gericht_details' => $gericht_details,
            'allergen_details' => $allergen_details,
            'ga_details' => $ga_details,
            'angemeldet' => $_SESSION['angemeldet'] ?? null,
            'url' => 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"
        ]);

    }

    public function call_anmeldung(RequestData $rd){
        return view('anmeldung.anmeldung_page', [
            'request' => $rd,
            'fehler' => $_SESSION['fehlermeldung'] ?? null,
            'url' => 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"
        ]);
    }

    public function call_verify(RequestData $rd){
        $verify = check_anmeldeDaten();
        if($verify === "Erfolgreich angemeldet"){
            header("Location:/hauptseite_Emensa");
        }
        else{
            $_SESSION['fehlermeldung'] = $verify;
            header("Location:/anmeldung");
        }
    }

    public function call_abmelden(RequestData $rd){
        $logger = logger();
        $logger->info($_SESSION['angemeldet']." hat sich abgemeldet");
        $_SESSION['angemeldet'] = null;
        $_SESSION['fehlermeldung'] = null;
        header("Location:/hauptseite_Emensa");
    }
}