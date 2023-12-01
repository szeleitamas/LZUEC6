<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Team;
use App\Models\User;
use App\Models\Group;
use App\Models\Track;
use App\MyClasses\CheckIds;
use App\MyClasses\RuleMessages;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TeamController extends Controller
{

    //Csapat menüpont megjelenítése
    public function index()
    {
        $team = Team::where('id', CheckIds::checkTeamId())->first();
        $teamCaptain = User::where('id', CheckIds::checkUserId())->first();
        $users = User::with('roles')->where('team_id', CheckIds::checkTeamId())->get();
        $days = Day::orderBy('name')->get();
        $tracks = Track::orderBy('name')->get();
        return view('teams.index', compact('team', 'teamCaptain', 'users', 'days', 'tracks'));
    }

    //Csapat menü szerkesztése
    public function edit(Team $team)
    {
        return view('teams.edit', [
            'team' => $team,
            'tracks' => Track::orderBy('name')->get(),
            'days' => Day::orderBy('id')->get(),
        ]);
    }

    //Csapat adatainak felülírása
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required|min:2|max:50'
        ], RuleMessages::messages());

        $team->update([
            'name' => $request->name,
            'day_id' => $request->day_id,
            'track_id' => $request->track_id,
        ]);

        return redirect(route('teams.index'));
    }


    //Csapat generálása fake adatokkal admin részéről AJAX hívással
    public function store(Request $request)
    { {
            $number = $request->number;

            for ($i = 1; $i <= $number; $i++) {
                Team::create([
                    'name' => "Nincs játék",
                    'track_id' => null,
                    'day_id' => null,
                    'group_id' => $request->group_id,
                ]);
            }

            return response()->json(['success' => 'A mentés sikeres']);
        }
    }



    //Csapat törlése a Listák / Csapatok menüpontból / csak fake csapatok esetén
    public function destroy($id)
    {
        Team::find($id)->delete();

        return response()->json(['success' => 'A törlés sikeres']);
    }



    //Listák főmenü csapat almenüjének nézete
    public function teamList()
    {
        $groups = Group::orderBy('name')->get();
        $teams = Team::orderBy('name')->get();
        return view('list.teams.index', compact('groups', 'teams'));
    }

    public function teamListShow(Team $team)
    {
        $users = User::where('team_id', $team->id)->get();
        return view('list.teams.show', [
            'team' => $team,
            'users' => $users,
        ]);
    }



//................................Admin / osztályokhoz rendelés ..........................................


    //Csapatok osztályhoz rendelésének nézete
    public function teamToGroupEdit(Team $team)
    {
        $groups = Group::orderBy('name')->get();
        return view('list.teams.teamtogroup', [
            'team' => $team,
            'groups' => $groups,
        ]);
    }

    //csapatok osztályának megváltoztatása
    public function teamToGroupUpdate(Request $request, Team $team)
    {
        $team->update([
            'group_id' => $request->group_id,
        ]);

        return redirect(route('teamList.index'))->with('success', 'Az osztályhoz rendelés sikeres');
    }


    //....................................SORSOLÁS.........................................................//
    //sorsolás menüpont nézete
    public function teamLot()
    {
        $teams = Team::get();
        $groups = Group::orderBy('name')->get();
        return view('list.lots.index', [
            'teams' => $teams,
            'groups' => $groups,
        ]);
    }


    //sorsolás megvalósítása
    public function teamLotAction(Team $team, $id)
    {
        $data = [];                                       //üres tömb létrehozása
        $teams = Team::where('group_id', $id)->get();
        $length = count($teams);
        for ($i = 1; $i <= $length; $i++) {         //tömb feltöltése számokkal
            $data[] = $i;
        }

        $shuffled = Arr::shuffle($data);        //tömb megkeverése

        $i = 0;
        foreach ($teams as $team) {             //csapat lot attr. felülírása
            $team->update([
                'lot' => $shuffled[$i],
            ]);

            $i++;
        }
        return back()->with('success', 'A sorsolás megtörtént!');
    }

    //.......................................................Kezdőoldal.....................................................................

    //Csapat eredményeinek kiiratása a kezdőoldalra
    public function getTeams()
    {
        $groups = Group::orderby('id')->get();
        $teams = Team::all();
        return view('welcome', compact('teams', 'groups'));
    }
}
