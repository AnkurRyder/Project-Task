<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\team;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    public function CreateTeam(Request $request) {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);
        $errors = $validatedData->errors();
        if($validatedData->failed()) {
            return response()->json($errors->all(), 400);
        }
        $uuid = Uuid::uuid4();
        $team = new team;
        $team->id = $uuid->toString();
        $team->name = $request->input('name');
        $team->save();
        return response()->json(['id' => $team->id, 'name' => $team->name]);;
    }

    public function Show($id)
    {
        $team = team::find($id)->get();
        return response()->json($team);
    }
}
