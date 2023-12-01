<?php

namespace App\Http\Controllers;

use App\Models\Turn;
use Illuminate\Http\Request;

class TurnController extends Controller
{
    //Nézet létrehozása
    public function index()
    {
        $turns = Turn::orderBy('id')->get();
        return view('admin.turns.index', compact('turns'));
    }


    //Forduló generálása (9 fordulós mérkőzésre)
    public function store()
    {
        for ($i = 1; $i <= 9; $i++) {
            Turn::create([
                'name' => $i . ". Forduló",
            ]);
        }

        return back()->with('success', 'A felvitel sikeres');
    }


    //Forduló törlése (Truncate)
    public function truncateTurn()
    {
        Turn::query()->truncate();

        return back()->with('success', 'A törlés sikeres');
    }
}
