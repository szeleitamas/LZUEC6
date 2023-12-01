<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\Phone;
use App\Models\Birthyear;
use App\MyClasses\CheckIds;
use Illuminate\Http\Request;
use App\Models\Registrationdata;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /*..........TEAMCAPTAIN........*/

    public function teamCaptainEdit(User $user)
    {
        return view('teams.teamCaptains.edit', [
            'user' => $user,
        ]);
    }

    public function teamCaptainUpdate(Request $request, User $user)
    {
        $user->update([
            'name' => $request->name,
        ]);

        $user->registrationdata->update([
            'email' => $request->email,
        ]);

        $user->phone->update([
            'phone' => $request->phone,
        ]);

        return redirect(route('teams.index'));
    }



    /*..........PLAYER........*/

    public function playerCreate()
    {
        return view('teams.players.create', [
            'user_id' => CheckIds::checkUserId(),
            'user_name' => User::where('id', CheckIds::checkUserId())->value('name'),
            'user' => User::with('roles')->where('id', CheckIds::checkUserId())->get(),
        ]);
    }

    public function playerStore(Request $request)
    {
        DB::transaction(function () use ($request) {

            $user = User::create([
                'name' => $request->name,
                'team_id' => CheckIds::checkTeamId(),
            ]);
            $user->roles()->attach('4');

            Birthyear::create([
                'birthyear' => $request->birthyear,
                'user_id' => $user->id,
            ]);
        });

        return redirect(route('teams.index'));
    }

    public function playerTeamCaptainStore(Request $request)
    {
        DB::transaction(function () use ($request) {

            User::find($request->user_id)->roles()->attach('4');

            Birthyear::create([
                'birthyear' => $request->birthyear,
                'user_id' => $request->user_id,
            ]);
        });

        return redirect(route('teams.index'));
    }

    public function playerEdit(User $user)
    {
        return view('teams.players.edit', [
            'user' => $user,
        ]);
    }

    public function playerUpdate(Request $request, User $user)
    {
        $user->update([
            'name' => $request->name,
        ]);

        $user->birthyear->update([
            'birthyear' => $request->birthyear,
        ]);

        return redirect(route('teams.index'));
    }

    public function playerDestroy(user $user)
    {
        $id = $user->roles()->where('role_id', '4')->get()->pluck('id');
        $user->roles()->detach($id);

        if ($user->roles()->where('user_id', $user->id)->exists()) {
            return redirect(route('teams.index'));
        } else {
            $user->delete();
        }

        return redirect(route('teams.index'));
    }



    /*..........DATARECORDER........*/
    public function dataRecorderCreate()
    {
        $users = User::with('roles')->where('team_id', CheckIds::checkTeamId())->get();
        return view('teams.dataRecorders.create', compact('users'));
    }

    //AJAX adatmentés
    public function dataRecorderStore(Request $request)
    {
        DB::transaction(function () use ($request) {

            Registrationdata::create([
                'email' => $request->email,
                'password' => Hash::make($request->pasword),
                'user_id' => $request->user_id,
            ]);

            User::find($request->user_id)->roles()->attach('3');
        });

        return response()->json(['success' => 'A mentés sikeres']);
    }



    public function dataRecorderDestroy($id)
    {
        DB::transaction(function () use ($id) {

            RegistrationData::where('user_id', $id)->delete();
            $id1 = $id->roles()->where('role_id', '3')->get()->pluck('id');
            $$id->roles()->detach($id1);
        });

        return "ok";
        /*
        return redirect(route('teams.index'));
        */
    }


    /*..........Admin Player List........*/

    public function playerList()
    {
        $users = User::with('roles')->orderBy('name')->get();
        return view('list.players.index', compact('users'));
    }

}
