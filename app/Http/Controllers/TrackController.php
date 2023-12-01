<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Track;
use Illuminate\Http\Request;
use App\MyClasses\RuleMessages;


class TrackController extends Controller
{
    //Adatok listázása
    public function index()
    {
        $tracks = Track::orderBy('name', 'asc')->get();
        return view('admin.tracks.index', compact('tracks'));
    }


   //AJAX szerkesztés
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:50',
        ], RuleMessages::messages());

        Track::updateOrCreate(
            [
                'id' => $request->track_id
            ],
            [
                'name' => $request->name,
            ]
        );

        return response()->json(['success' => 'A mentés sikeres']);
    }


    //AJAX szerkesztés
    public function edit($id)
    {
        $track = Track::find($id);
        return response()->json($track);
    }


    //AJAX törlés
    public function destroy($id)
    {
        Track::find($id)->delete();

        return response()->json(['success'=>'A törlés sikeres']);
    }
}
