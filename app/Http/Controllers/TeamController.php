<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\team;
use Ramsey\Uuid\Uuid;

class TeamController extends Controller
{
    public function CreateTeam(Request $request) {
        $uuid = Uuid::uuid4();
        $team = new team;
        $team->id = $uuid->toString();
        $team->name = $request->input('name');
        $team->save();
        return response('Hello World', 200)->json(['id' => $team->id, 'name' => $team->name]);;
    }

    public function Show($id)
    {
        $team = team::find($id);
        return response()->json(['id' => $team->id, 'name' => $team->name]);
    }
}
