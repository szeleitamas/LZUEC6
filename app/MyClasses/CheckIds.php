<?php

namespace App\MyClasses;

use Illuminate\Support\Facades\Auth;

class CheckIds
{
    //Bejelentkezett felhasználó user id-ja
    static function checkUserId()
    {
        $user_id = Auth::user()->user->id;
        return $user_id;
    }

    //Bejelentkezett felhasználó szerepkör ellenőrzés
    static function checkRoleId()
    {

        $role_id = Auth::user()->user->roles->sortBy('id')->first()->id;
        return $role_id;
    }
    //Bejelentkezett felhasználó csapatának ellenőrzés
    static function checkTeamId()
    {
        $team_id = Auth::user()->user->team_id;
        return $team_id;
    }
}
