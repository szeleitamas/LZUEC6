<?php

namespace App\MyClasses;

//Saját osztály a szabályok hibaüzeneteinek kezelése végett
class RuleMessages
{
    static function messages() {
        $messages = [
            '*.required' => 'A mező kitöltése kötelező',
            '*.unique' => 'Már szerepel ilyen felvitt érték, adjon meg másikat',
            '*.email' => 'Csak email formátumú mező bevitele engedélyezett',
            '*.min' => 'A mezőnek minimum 2 karakter hosszúnak kell lennie',
            'name.max' => 'A mező maximum 50 karakter hosszúságú lehet',
            'email.exists' => 'A megadott email cím nem megfelelő',
            'password.min' => 'A megadott jelszónak minimum 5 karakter hosszúnak kell lennie',
            'password.confirmed' => 'A megadott jelszavak nem egyeznek',
            'password.exists' => 'A megadott jelszó nem megfelelő',
            'password.regex' => 'A jelszónak kisbetűt, nagybetűt és számot is kell tartalmaznia',
            'new_password.min' => 'A megadott jelszónak minimum 5 karakter hosszúnak kell lennie',
            'new_password.confirmed' => 'A megadott jelszavak nem egyeznek',
            'new_password.exists' => 'A megadott jelszó nem megfelelő',
            'new_password.regex' => 'A jelszónak kisbetűt, nagybetűt és számot is kell tartalmaznia',
            'phone.regex' => 'A megadott formátum nem megfelelő',
        ];

        return $messages;
    }
}
