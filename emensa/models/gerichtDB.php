<?php
class Gericht extends Illuminate\Database\Eloquent\Model
{
    protected $primaryKey = '$id';
    protected $table = '$gericht';
    protected $attributes = [
        'name' => 'placeholder name',
        'beschreibung' => 'placeholder desc',
        'vegetarisch' => false,
        'vegan' => false,
        'preis_intern' => 0.0,
        'preis_extern' => 0.0,
        'bildname' => '00_image_missing.jpg'
    ];

    function getInternPreis($val): string
    {
        return number_format($val, 2);
    }
    function getExternPreis($val): string
    {
        return number_format($val, 2);
    }
    function setVeganAttribute($val)
    {
        $val = strtolower($val);
        $val = ucfirst($val);
        $val = trim($val);

        if($val == 'Yes' || $val == 'Ja')
            $val = true;
        elseif($val == 'No' || $val == 'Nein')
            $val = false;
        else
            $val = false;

        $this->attributes['vegan']=$val;
    }
}