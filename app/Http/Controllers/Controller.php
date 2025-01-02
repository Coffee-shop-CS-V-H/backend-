<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class Controller
{
    
    //megjelenít
    public function index(){
        return User::all();
    }



    //újonnan létrehozott aadatok tárolása

    public function store(Request $request){
        $record = new User();
        $record->fill($request->all());
        $record->save();
    }


    //megjelenít
    public function show( $id){
        return User::find($id);
    }

    //frissít
    public function update(Request $request, $id){
        $record=User::find($id);
        $record->fill($request->all());
        $record->save();
        }

    //töröl

    public function destroy($id){
        User::find($id)->delete();
    }
}
