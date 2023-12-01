<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\MyClasses\RuleMessages;
use Illuminate\Http\Request;

class DayController extends Controller
{
    //Adatok listázása
    public function index()
    {
        $days = Day::get()->sortBy('id');
        return view('admin.days.index', compact('days'));
    }


    //AJAX szerkesztés
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:50',
        ], RuleMessages::messages());

        Day::updateOrCreate(
            [
                'id' => $request->day_id
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
        $day = Day::find($id);
        return response()->json($day);
    }


    //AJAX törlés
    public function destroy($id)
    {
        Day::find($id)->delete();

        return response()->json(['success'=>'A törlés sikeres']);
    }
}
