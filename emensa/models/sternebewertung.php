<?php
class Sternebewertungen extends Illuminate\Database\Eloquent\Model
{
    protected $primaryKey = 'id';
    protected $table = 'sternebewertungen';
    protected $attributes = [
        'bemerkung' => 'Placeholder for bemerkung',
        'sternebewertung' => 0,
        'hervorgegeben' =>false,
        'benutzer_fk' => 1,
        'gericht_fk' =>1
    ];

    function getRating($value): ?string
    {
        return match ($value) {
            1 => 'sehr schlecht',
            2 => 'schlecht',
            3 => 'gut',
            4 => 'sehr gut',
            default => null,
        };
    }
}