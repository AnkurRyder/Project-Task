<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Task;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Validator;
use function GuzzleHttp\Promise\task;

class MemberController extends Controller
{
    public function CreateMember($id, Request $request) {
        $data = $request->all();
        $data['id'] = $id;
        $validatedData = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email:rfc',
            'id' => 'UUID',
        ]);
        $errors = $validatedData->errors();
        if($validatedData->failed()) {
            return response()->json($errors->all(), 400);
        }
        $uuid = Uuid::uuid4();
        $member = new Member;
        if(Member::where(['email' => $member->email])->count() == 0) {
            try {
                $member->Create($uuid->toString(), $id, $request->input('name'),$request->input('email') );
            } catch (\Illuminate\Database\QueryException $e) {
                return response()->json('Team ID does not exist', 400);
            }
            return response()->json($member);
        }
        return response()->json('Email already associated with a team member', 400);
    }

    public function DeleteMember($id1, $id2) {
        $data['id1'] = $id1;
        $data['id2'] = $id2;
        $validatedData = Validator::make($data, [
            'id1' => 'UUID',
            'id2' => 'UUID',
        ]);
        $errors = $validatedData->errors();
        if($validatedData->failed()) {
            return response()->json($errors->all(), 400);
        }
        if (MemberController::AllTaskDone($id2)) {
            $member = Member::where(['id' => $id2, 'idt' => $id1]);
            $count = $member->count();
            if($count == 0)
                return response("Check ID", 400);
            $member->delete();
            return response('No Content', 204);
        }
        return response('Member cannot be deleted, please reassign all tasks from this member to someone else before trying again', 400);
    }

    public static function AllTaskDone($id) {
        $tasks = Task::where(['assignee_id' => $id])->get();
        foreach ($tasks as $task) {
            if($task->status == 'todo') {
                return false;
            }
        }
        return true;
    }
}
