<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function Create($id, $idt, $title, $description, $assignee_id, $status) {
        $this->id = $id;
        $this->idt = $idt;
        $this->title = $title;
        $this->description = $description;
        $this->assignee_id = $assignee_id;
        $this->status = $status;
        $this->save();
    }

    public function assignment($idt, $assignee_id){
        $count = Member::where(['id' => $assignee_id, 'idt' => $idt])->count();
        if ($count == 0)
            return false;
        return true;
    }

    public function Change($title, $description, $assignee_id, $status) {
        $this->title = $title;
        $this->description = $description;
        $this->assignee_id = $assignee_id;
        $this->status = $status;
        $this->save();
    }
}
