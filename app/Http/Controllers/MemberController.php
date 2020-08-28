<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use Ramsey\Uuid\Uuid;

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
        // Delete if all task are done
    }
}
