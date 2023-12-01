<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Phone;
use App\MyClasses\CheckIds;
use Illuminate\Http\Request;
use App\MyClasses\RuleMessages;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller
{
    //játékosok nézete
    public function index()
    {
        $users = User::where('team_id', CheckIds::checkTeamId())->get();
        return view('teams.players.index', compact('users'));
    }


    //játékosok felvitele és szeresztése AJAX
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:50|string',
        ], RuleMessages::messages());

        try {

            DB::transaction(function () use ($request) {

                $user = User::create(
                    [
                        'name' => $request->name,
                        'team_id' => CheckIds::checkTeamId(),
                    ]
                );

                $user->roles()->attach('4');

            });
        } catch (Exception $e) {

            return redirect(route('players.index'))->with('error', $e->getMessage());
        }

        return response()->json(['success' => 'A mentés sikeres']);
    }


    //Játékos szerkesztés
    public function edit(User $user)
    {
        return view('teams.players.edit', [
            'user' => $user,
        ]);
    }


    //Játékos adatainak felülírása
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|min:2|max:50',
        ], RuleMessages::messages());

        $user->update([
            'name' => $request->name,
        ]);

        if (CheckIds::checkRoleId() === 1) {
            return redirect(route('playerList.index'))->with('success', 'A módosítás sikerült!');
        } else {
            return redirect(route('players.index'))->with('success', 'A módosítás sikerült!');
        }
    }


    public function destroy(User $user)
    {
        $admin_id = $user->roles()->where('role_id', '2')->get()->pluck('id');
        if (!$admin_id) {
            $user->delete();
        } else {
            $user->roles()->detach('4');
        }
        return redirect(route('players.index'))->with('success', 'A törlés sikeres');
    }

    //.............................................Lista / user menü.................................................
    //Lista főmenü játékosok almenü megjelenítése
    public function playerList()
    {
        $users = User::with('roles')->orderBy('name')->get();
        return view('list.players.index', compact('users'));
    }


    //Felhasználó státuszának metódusa
    public function playerStatusUpdate(Request $request, User $user)
    {
        if ($user) {
            if ($user->status) {
                $user->update([
                    'status' => 0,
                ]);
            } else {
                $user->update([
                    'status' => 1,
                ]);
            }
        }

        return back();
    }
}
