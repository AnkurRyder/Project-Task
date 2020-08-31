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
            'name' => 'required|max:255|alpha_dash',
        ]);
        $errors = $validatedData->errors();
        if($validatedData->failed()) {
            return response()->json($errors->all(), 400);
        }
        $uuid = Uuid::uuid4();
        $team = new team;
        $team->Create($uuid->toString(),$request->input('name'));
        return response()->json($team);;
    }

    public function Show($id)
    {
        $data['id'] = $id;
        $validatedData = Validator::make($data, [
            'id' => 'UUID',
        ]);
        $errors = $validatedData->errors();
        if($validatedData->failed()) {
            return response()->json($errors->all(), 400);
        }
        $team = team::find($id);
        return response()->json($team);
    }
}
