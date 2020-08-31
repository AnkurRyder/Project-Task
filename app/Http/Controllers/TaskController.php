<?php

namespace App\Http\Controllers;

use App\Member;
use App\Task;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public function CreateTask($id, Request $request) {
        $data = $request->all();
        $data['id'] = $id;
        $validatedData = Validator::make($data, [
            'title' => 'required|max:255',
            'description' => '',
            'assignee_id' => ['nullable', 'UUID'],
            'status' => [
                'required',
                Rule::in(['todo', 'done']),
            ],
            'id' => 'UUID',
        ]);
        $errors = $validatedData->errors();
        if($validatedData->failed()) {
            return response()->json($errors->all(), 400);
        }
        $task = new Task();
        $uuid = Uuid::uuid4();
        $task->id = $uuid->toString();
        $task->idt = $id;
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->assignee_id = $request->input('assignee_id');
        $task->status = $request->input('status');
        if (TaskController::assignment($task) || $task->assignee_id == ''){
            try {
                $task->save();
              } catch (\Illuminate\Database\QueryException $e) {
                return response()->json('Team ID does not exist', 400);
              }
            return response()->json($task);
        }
        return response('assignee_id should belong to the same team as the task', 400);
    }

    public static function assignment(Task $task){
        $count = Member::where(['id' => $task->assignee_id, 'idt' => $task->idt])->count();
        if ($count == 0)
            return false;
        return true;
    }

    public function UpdateTask($id1, $id2, Request $request) {
        $data = $request->all();
        $data['id1'] = $id1;
        $data['id2'] = $id2;
        $validatedData = Validator::make($data, [
            'title' => 'required|max:255',
            'description' => '',
            'assignee_id' =>  ['nullable', 'UUID'],
            'status' => [
                'required',
                Rule::in(['todo', 'done']),
            ],
            'id1' => 'UUID',
            'id2' => 'UUID',
        ]);
        $errors = $validatedData->errors();
        if($validatedData->failed()) {
            return response()->json($errors->all(), 400);
        }
        $task = Task::where(['id' => $id2, 'idt' => $id1])->get()->first();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->assignee_id = $request->input('assignee_id');
        $task->status = $request->input('status');
        if (TaskController::assignment($task) || $task->assignee_id == ''){
            try {
                $task->save();
              } catch (\Illuminate\Database\QueryException $e) {
                return response()->json('Team ID does not exist', 400);
              }
            return response()->json($task);
        }
        return response('assignee_id should belong to the same team as the task', 400);
    }

    public function ShowTask($id1, $id2) {
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
        $task = Task::where(['id' => $id2, 'idt' => $id1])->get();
        return response()->json($task);
    }

    public function ShowTasks($id1) {
        $data['id1'] = $id1;
        $validatedData = Validator::make($data, [
            'id1' => 'UUID',
        ]);
        $errors = $validatedData->errors();
        if($validatedData->failed()) {
            return response()->json($errors->all(), 400);
        }
        $task = Task::where(['idt' => $id1, 'status' => 'todo'])->simplePaginate(5);
        return response()->json($task);
    }

    public function ShowMemberTasks($id1, $id2) {
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
        $task = Task::where(['assignee_id'=> $id2, 'idt' => $id1, 'status' => 'todo'])->simplePaginate(5);
        return response()->json($task);
    }
}
