<?php

namespace App\Faker;
use Faker\Provider\Base;

class FrameworkProvider extends Base{

    protected static $teams = [
        'Hetesfogat',
        'Salakmenők',
        'Pötyi',
        'Radír',
        'Ütőmágusok',
        'Love Game',
        'Erőnyerők',
        'ATTU',
        'Los Matados',
        'Termo',
        'Bakhát',
        'KEK',
        'Gambriniusz',
        'Orvosok',
        'Úrihegy',
        'Vamos',
        'Energy',
        'Grand Slam',
        'Aprico',
        'Démász',
        'Lakitaksz',
        'Rakett',
        'Grácia',
        'Fireball',
        'Metlife',
        'Sárga',
        'ZST',
        'Az-Land',
        'Skeleton',
        'Saphire',
        'Lusták',
        'Tuti',
        'Ügyvédek',
        'NK',
        'Neka',
        'Elektro',
        'Égbolt',
        'Alabástrom',
        'Hoppáré',
        'Firenze',
    ];

    public function team(): string
    {
        return static::randomElement(static::$teams);
    }


    protected static $tracks = [
        'Bakó Sport',
        'Gamf',
        'Úrihegy',
        '607-es',
        'Újhidy',
        'KATE',
        'Kertészeti',
        'MOL',
    ];

    public function track(): string
    {
        return static::randomElement(static::$tracks);
    }


}
