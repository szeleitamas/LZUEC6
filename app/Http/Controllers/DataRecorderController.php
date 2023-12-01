<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Phone;
use App\MyClasses\CheckIds;
use Illuminate\Http\Request;
use App\MyClasses\RuleMessages;
use App\Models\Registrationdata;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DataRecorderController extends Controller
{
    //Adatrögzítő nézet
    public function index()
    {
        $dataRecorders = User::where('team_id', CheckIds::checkTeamId())->get();
        return view('teams.datarecorders.index', compact('dataRecorders'));
    }

    //Adatrögzítő felvitele AJAX nézet
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:50|unique:registrationdatas',
            'password' => 'required|string|min:5|confirmed|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/',
        ], RuleMessages::messages());

        try {
            DB::transaction(function () use ($request) {

                Registrationdata::create([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'user_id' => $request->player_id,
                ]);

                $dataRecorder = User::where('id', $request->player_id)->first();
                $dataRecorder->roles()->attach('3');
            });
        } catch (Exception $e) {

            return redirect(route('dataRecorders.index'))->with('error', $e->getMessage());
        }

        return response()->json(['success' => 'A mentés sikeres']);
    }



    //Adatrögzítő szerkesztése
    public function edit(User $dataRecorder)
    {
        return view('teams.dataRecorders.edit', [
            'dataRecorder' => $dataRecorder,
        ]);
    }

    //Adatrögzítő adatainak felülírása
    public function update(Request $request, User $dataRecorder)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:50',
            'email' => 'required|string|email|max:50',
        ], RuleMessages::messages());

        $dataRecorder->update([
            'name' => $request->name,
        ]);

        $dataRecorder->registrationdata()->update([
            'email' => $request->email,
        ]);

        return redirect(route('dataRecorders.index'));
    }


    public function destroy(User $dataRecorder)
    {
        try {
            DB::transaction(function () use ($dataRecorder) {

                RegistrationData::where('user_id', $dataRecorder)->delete();
                $id = $dataRecorder->roles()->where('role_id', '3')->get()->pluck('id');
                $dataRecorder->roles()->detach($id);
            });
        } catch (Exception $e) {

            return redirect(route('dataRecorders.index'))->with('error', $e->getMessage());
        }


        return redirect(route('dataRecorders.index'))->with('success', 'A törlés sikeres');
    }
}
