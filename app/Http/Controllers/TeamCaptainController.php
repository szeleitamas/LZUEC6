<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\MyClasses\CheckIds;
use Illuminate\Http\Request;
use App\MyClasses\RuleMessages;

class TeamCaptainController extends Controller
{
    //Csapatkapitány nézet
    public function index()
    {
        $teamCaptain = User::where('id', CheckIds::checkUserId())->first();
        return view('teams.teamcaptains.index', compact('teamCaptain'));
    }


    //Csapatkapitány szerkesztés nézete a teams/index fájlból meghívva
    public function edit(User $teamCaptain)
    {
        return view('teams.teamcaptains.edit', [
            'teamCaptain' => $teamCaptain,
        ]);
    }


    //Csapatkapitány adatainak felülírása
    public function update(Request $request, User $teamCaptain)
    {
        $request->validate([
            'name' => 'required|min:2|max:50',
            'email' => 'required|email|max:50',
            'phone' => 'required|regex:/^\+36[0-9]{9}/',
        ], RuleMessages::messages());

        $teamCaptain->update([
            'name' => $request->name,
        ]);

        $teamCaptain->registrationdata()->update([
            'email' => $request->email,
        ]);

        $teamCaptain->phone()->update([
            'phone' => $request->phone,
        ]);

        return redirect(route('teamCaptains.index'));
    }


    public function addPlayer(User $teamCaptain)
    {

        $teamCaptain->roles()->attach('4');

        return redirect(route('teamCaptains.index'))->with('success', 'A csapatkapitány hozzá lett rendelve a játékosokhoz');

    }
}
