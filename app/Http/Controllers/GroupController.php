<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use App\MyClasses\RuleMessages;

class GroupController extends Controller
{
    //Adatok listázása
    public function index()
    {
        $groups = Group::get()->sortBy('id');
        return view('admin.groups.index', compact('groups'));
    }

   //AJAX szerkesztés
   public function store(Request $request)
   {
       $request->validate([
           'name' => 'required|min:2|max:50',
       ], RuleMessages::messages());

       Group::updateOrCreate(
           [
               'id' => $request->group_id
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
        $group = Group::find($id);
        return response()->json($group);
    }


    //AJAX törlés
    public function destroy($id)
    {
        Group::find($id)->delete();
        return response()->json(['success'=>'A törlés sikeres']);
    }
}
