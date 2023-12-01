<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MyClasses\RuleMessages;

class AdminController extends Controller
{
    //Törzsadatok / Admin nézet létrehozása
    public function index()
    {
        $admins = User::with('roles')->orderBy('name')->get();
        return view('admin.admins.index', compact('admins'));
    }


     //Admin menü szerkesztése
     public function edit(User $admin)
     {
         return view('admin.admins.edit', [
             'admin' => $admin,
           ]);
     }


     //Admin adatainak felülírása
     public function update(Request $request, User $admin)
     {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'phone' => 'required|regex:/^\+36[0-9]{9}/',
        ], RuleMessages::messages());

         $admin->update([
             'name' => $request->name,
         ]);

         $admin->registrationdata->update([
            'email' => $request->email,
         ]);

         $admin->phone->update([
            'phone' => $request->phone,
         ]);

         return redirect(route('admins.index'))->with('success', 'A módosítás sikerült');
     }
}
