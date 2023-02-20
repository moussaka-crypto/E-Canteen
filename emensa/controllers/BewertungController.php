<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/../models/sternebewertung.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gerichtDB.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gerichteUallergene.php');

class BewertungController
{
    public function bewertung()
    {
        $gerichtid = $_GET['gerichtid'];
        $_SESSION['gerichtid'] = $gerichtid;

        $bewertungen = Sternebewertungen::query()
            ->orderBy('bewertungszeitpunkt', 'DESC')
            -> limit(30)
            ->select('benutzer.email', 'sternebewertung', 'bewertungszeitpunkt','gericht.name',
                'id','hervorgehoben','preis_intern','preis_extern')
            ->join('benutzer','benutzer.id','=','sternebewertung.benutzer_fk')
            ->join('gericht','gericht.id','=','sternebewertung.gericht_fk')
            ->get();
        $data = ['gericht' => Gericht::query()->find($gerichtid), 'bewertungen'=>$bewertungen];
        return view("bewertungsLayout", $data);
    }

    public function saveBewertung()
    {
        $benutzerid = $_SESSION['benutzerid'];
        $gerichtid = $_SESSION['gerichtid'];
        $bewertung = new Sternebewertungen();
        $bewertung->benutzer_fk = $benutzerid;
        $bewertung->gericht_fk = $gerichtid;
        $bewertung->sternebewertung = $_POST['bewertung'];
        $bewertung->bewertungszeitpunkt = date('Y-m-d');
        $bewertung->bemerkung = $_POST['bemerkung'];
        $bewertung->timestamps = false;

        if (isset($_POST['hervorgehoben']) && $_POST['hervorgehoben'] == 'on'){
            $bewertung->hervorgehoben = true;
        }
        else{
            $bewertung->hervorgehoben = false;
        }
        $bewertung->save();

        $data=['tabelle'=>gerichte_und_allergene()];
        return view('werbeseiteLayout', $data);
    }

    public function meineBewertungen()
    {
        $benutzerid = $_SESSION['benutzerid'];
        $bewertungen = Sternebewertungen::query()
            ->orderBy('gericht.id','ASC')
            ->select('benutzer.email',
                'bemerkung',
                'sternebewertung',
                'bewertungszeitpunkt',
                'gericht.name',
                'id',
                'hervorgehoben','preis_intern'
                ,'preis_extern')
            ->join('benutzer','benutzer.id','=','sternebewertung.benutzer_fk')
            ->join('gericht','gericht.id','=','sternebewertung.gericht_fk')
            ->where('benutzer.id','=',$benutzerid)
            ->get();

        $data = ['bewertungen' => $bewertungen];
        return view("meineBewertungen", $data);
    }

    public function deleteBewertung(){
        $bewertungsid = $_POST['bewertungsid'];
        $bewertung = Sternebewertungen::find($bewertungsid);
        $bewertung->delete();
        header('Location: /meinebewertungen',true);
    }

    public function gerichthervorheben(){
        if ($_SESSION['admin'])
        {
            $bewertungsid = $_GET['bewertungsid'];
            $bewertung = Sternebewertungen::query()->find($bewertungsid);
            $bewertung->hervorgehoben = !$bewertung->hervorgehoben;
            $bewertung->timestamps = false;
            $bewertung->save();
        }
        header('Location: /hauptseite_Emensa',true);
    }
}
