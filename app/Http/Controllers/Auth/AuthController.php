<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\Day;
use App\Models\Team;
use App\Models\User;
use App\Models\Phone;
use App\Models\Track;
use App\MyClasses\CheckIds;
use Illuminate\Http\Request;
use App\MyClasses\RuleMessages;
use App\Models\Registrationdata;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Regisztrációs űrlap adatai, pálya és játéknap adatai átadva a nézetnek
    public function registrationCreate()
    {
        $tracks = Track::orderBy('name')->get();
        $days = Day::orderBy('id')->get();
        return view('auth.registration', compact('tracks', 'days'));
    }

    //Regisztráció metódusa, ellenőrzött adatbekéréssel, tranzakciókezeléssel
    public function registrationStore(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:50',
            'email' => 'required|email|max:50|unique:registrationdatas',
            'phone' => 'required|regex:/^\+36[0-9]{9}/|unique:phones',
            'password' => 'required|min:5|confirmed|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/',
            'team_name' => 'required|min:2|max:50|unique:teams,name',
            'day_id' => 'required',
            'track_id' => 'required',
        ], RuleMessages::messages());

        try {
            DB::transaction(function () use ($request) {
                $team = Team::create([
                    'name' => $request->team_name,
                    'track_id' => $request->track_id,
                    'day_id' => $request->day_id,
                ]);

                $user = User::create([
                    'name' => $request->name,
                    'team_id' => $team->id,
                ]);
                $user->roles()->attach('2');

                Phone::create([
                    'phone' => $request->phone,
                    'user_id' => $user->id,
                ]);

                Registrationdata::create([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'user_id' => $user->id,
                ]);
            });
        } catch (Exception $e) {

            return redirect(route('registration.create'))->with('error', $e->getMessage());
        }

        return redirect(route('login.create'))->with('success', 'A regisztráció sikeres');
    }



    //Bejelentkező űrlap
    public function loginCreate()
    {
        return view('auth.login');
    }

    //Bejelentkezés metódusa, ellenőrzött adatbekéréssel
    public function loginStore(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], RuleMessages::messages());

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('homepage'));
        }

        return back()->with('error', 'A hitelesítő adatok nem megfelelőek! Ismételje meg a belépést!');
    }

    //Kilépés metódusa
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }



    //........................................JELSZÓ MÓDOSÍTÁS.................................................
    //Jelszó módosítás nézete
    public function passwordChange()
    {
        return view('auth.password-change');
    }

    //jelszó módostás
    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:5|confirmed|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/',
        ], RuleMessages::messages());

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return back()->with("error", "A régi jelszó nem egyezik! Kérem próbálja meg újra");
        }

        Registrationdata::where('user_id', Auth::user()->user->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        if (CheckIds::checkRoleId() === 1) {
            return redirect(route('admins.index'))->with('success', 'A jelszó módosítás sikerült!');
        } else {
            return redirect(route('teams.index'))->with("success", "A jelszó módosítás sikerült!");
        }

    }


    //........................................ELFELEJTETT JELSZÓ.................................................
    //Jelszó módosítás nézete
    public function forgotPasswordChange()
    {
        return view('auth.forgot_password');
    }

    //jelszó módostás
    public function forgotPasswordUpdate(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:registrationdatas',
            'new_password' => 'required|min:5|confirmed',
        ], RuleMessages::messages());


        $checkEmail = Registrationdata::where('email', $request->email)->first();

        if (!$checkEmail) {
            return back()->with("error", "Az email cím nem megfelelő");
        }

        Registrationdata::where('email', $request->email)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect(route('login.create'))->with("success", "A jelszó módosítás sikerült!");
    }
}
