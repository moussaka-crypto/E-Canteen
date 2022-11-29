<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/erste_5_gerichte.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');

class HauptseiteController
{
    public function call_hauptseite(RequestData $rd)
    {
        $erste_5 = collect_first_5();
        $gericht_details = db_5_gericht();
        $allergen_details = db_code_allergen();
        $ga_details = db_gericht_allergen();

        return view('hauptseite.display_hauptseite', [
            'request' => $rd,
            'erste_5' => $erste_5,
            'gericht_details' => $gericht_details,
            'allergen_details' => $allergen_details,
            'ga_details' => $ga_details,
            'url' => 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"
        ]);

    }
}