<?php

namespace App\Http\Controllers;

use App\Member;
use App\Task;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function CreateTask($id, Request $request) {
        $task = new Task();
        $uuid = Uuid::uuid4();
        $task->id = $uuid->toString();
        $task->idt = $id;
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->assignee_id = $request->input('assignee_id');
        $task->status = $request->input('status');
        if (TaskController::assignment($task) || $task->assignee_id == ''){
            $task->save();
            return response()->json($task);
        }
        return response('assignee_id should belong to the same team as the task', 400);
    }

    public static function assignment(Task $task){
        $member = Member::where(['id' => $task->assignee_id, 'idt' => $task->idt])->get();
        if ($member == null)
            return false;
        return true;
    }

    public function UpdateTask($id1, $id2, Request $request) {
        $task = Task::where('id', $id2, 'AND', 'idt', $id1);
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->assignee_id = $request->input('assignee_id');
        $task->status = $request->input('status');
        if (TaskController::assignment($task)){
            $task->save();
            return response()->json($task);
        }
        return response('assignee_id should belong to the same team as the task', 400);
    }

    public function ShowTask($id1, $id2) {
        $task = Task::where(['id' => $id2, 'idt' => $id1])->get();
        return response()->json($task);
    }

    public function ShowTasks($id1) {
        $task = Task::where(['idt' => $id1])->get();
        return response()->json($task);
    }

    public function ShowMemberTask($id1, $id2) {
        $task = Task::where(['assignee_id'=> $id2, 'idt' => $id1])->get();
        return response()->json($task);
    }
}
