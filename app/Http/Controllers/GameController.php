<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
use App\Models\Turn;
use App\Models\Group;
use App\MyClasses\CheckIds;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class GameController extends Controller
{
    //Eredményrögzítés kezdőoldala, belépett felhasználó ellenőrzéssel
    public function index()
    {
        if (CheckIds::checkRoleId() === 1) {                //szerepkör ellenőrzés
            $games = Game::orderBy('group_id')->orderBy('turn_id')->get();

            return view('games.index', compact('games'));
        } else {
            $games = Game::where('homeTeam_id', CheckIds::checkTeamId())->orderBy('group_id')->orderBy('turn_id')->get();

            return view('games.index', compact('games'));
        }
    }


    //Eredményrögzítés megvalósítása
    public function edit(Game $game)
    {
        return view('games.edit', [
            'game' => $game
        ]);
    }


    //Eredményfelvitel metódusa
    public function update(Request $request, Game $game)
    {
        $game->update([
            'homePlayer1_id' => $request->homeTeamPlayer1_id,
            'awayPlayer1_id' => $request->awayTeamPlayer1_id,
            'homePlayer1Point' => $request->homePlayer1Point,
            'awayPlayer1Point' => $request->awayPlayer1Point,
            'homePlayer2_id' => $request->homeTeamPlayer2_id,
            'awayPlayer2_id' => $request->awayTeamPlayer2_id,
            'homePlayer2Point' => $request->homePlayer2Point,
            'awayPlayer2Point' => $request->awayPlayer2Point,
            'homePPlayer1_id' => $request->homeTeamPPlayer1_id,
            'homePPlayer2_id' => $request->homeTeamPPlayer2_id,
            'awayPPlayer1_id' => $request->awayTeamPPlayer1_id,
            'awayPPlayer2_id' => $request->awayTeamPPlayer2_id,
            'homePPlayerPoint' => $request->homePPlayerPoint,
            'awayPPlayerPoint' => $request->awayPPlayerPoint,
        ]);

        //kezdőoldal elért pontok kiírása
        $homePlayer1Point = $request->homePlayer1Point;
        $awayPlayer1Point = $request->awayPlayer1Point;
        $homePlayer2Point = $request->homePlayer2Point;
        $awayPlayer2Point = $request->awayPlayer2Point;
        $homePPlayerPoint = $request->homePPlayerPoint;
        $awayPPlayerPoint = $request->awayPPlayerPoint;


        $homeSummPoints = $game->homeTeam()->first()->points;
        $awaySummPoints = $game->awayTeam()->first()->points;

        if ($homePlayer1Point > $awayPlayer1Point) {
            $homeSummPoints += 1;
        } else {
            $awaySummPoints += 1;
        }

        if ($homePlayer2Point > $awayPlayer2Point) {
            $homeSummPoints += 1;
        } else {
            $awaySummPoints += 1;
        }

        if ($homePPlayerPoint > $awayPPlayerPoint) {
            $homeSummPoints += 1;
        } else {
            $awaySummPoints += 1;
        }

        $game->homeTeam()->update([
            'points' => $homeSummPoints,
        ]);

        $game->awayTeam()->update([
            'points' => $awaySummPoints,
        ]);

        return redirect(route('games.index'))->with('success', 'Az adatfelvitel sikeres');
    }


    //Sorsolássi táblázat kialakítása
    public function action($id)
    {
        Game::where('group_id', $id)->delete();

        $data = [];
        $teams = Team::where('group_id', $id)->orderBy('lot')->get();

        foreach ($teams as $team) {
            $data[] = $team->id;
        }

        $array_1 = [0, 9, 1, 8, 2, 7, 3, 6, 4, 5];
        $array_2 = [8, 0, 7, 1, 6, 2, 5, 3, 4, 9];
        $array_3 = [0, 7, 1, 6, 2, 5, 3, 4, 9, 8];
        $array_4 = [6, 0, 5, 1, 4, 2, 3, 9, 7, 8];
        $array_5 = [0, 5, 1, 4, 2, 3, 8, 6, 9, 7];
        $array_6 = [4, 0, 3, 1, 9, 2, 5, 8, 6, 7];
        $array_7 = [0, 3, 1, 2, 7, 5, 8, 4, 9, 6];
        $array_8 = [2, 0, 1, 9, 3, 8, 4, 7, 6, 5];
        $array_9 = [0, 1, 8, 2, 7, 3, 6, 4, 5, 9];


        for ($i = 1; $i <= 9; $i++) {

            $t = "array_$i";
            Game::create([
                'group_id' => $id,
                'turn_id' => $i,
                'homeTeam_id' => $data[$$t[0]],
                'awayTeam_id' => $data[$$t[1]],
            ]);
            Game::create([
                'group_id' => $id,
                'turn_id' => $i,
                'homeTeam_id' => $data[$$t[2]],
                'awayTeam_id' => $data[$$t[3]],
            ]);
            Game::create([
                'group_id' => $id,
                'turn_id' => $i,
                'homeTeam_id' => $data[$$t[4]],
                'awayTeam_id' => $data[$$t[5]],
            ]);
            Game::create([
                'group_id' => $id,
                'turn_id' => $i,
                'homeTeam_id' => $data[$$t[6]],
                'awayTeam_id' => $data[$$t[7]],
            ]);
            Game::create([
                'group_id' => $id,
                'turn_id' => $i,
                'homeTeam_id' => $data[$$t[8]],
                'awayTeam_id' => $data[$$t[9]],
            ]);
        }

        Team::where('group_id', $id)->update([
            'start_date' => Carbon::now(),
            'points' => null,
        ]);



        return back()->with('success', 'A bajnokság indítása megtörtént!');
    }

    public function gamesLots()
    {
        $groups = Group::orderBy('name')->get();
        $turns = Turn::orderBy('id')->get();
        $games = Game::get();
        return view(
            'games.lots.index',
            compact(
                'groups',
                'turns',
                'games',
            )
        );
    }
}
