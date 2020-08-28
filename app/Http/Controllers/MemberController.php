<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Task;
use Ramsey\Uuid\Uuid;

use function GuzzleHttp\Promise\task;

class MemberController extends Controller
{
    public function CreateMember($id, Request $request) {
        $uuid = Uuid::uuid4();
        $member = new Member;
        $member->id = $uuid->toString();
        $member->idt = $id;
        $member->name = $request->input('name');
        $member->email = $request->input('email');
        $member->save();
        return response()->json($member);
    }

    public function DeleteMember($id1, $id2) {
        if (MemberController::AllTaskDone($id2)) {
            $member = Member::where(['id' => $id2, 'idt' => $id1])->get();
            if($member == null)
                return response("Check team ID", 400);
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
