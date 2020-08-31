<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function Create($id, $idt, $name, $email) {
        $this->id = $id;
        $this->idt = $idt;
        $this->name = $name;
        $this->email = $email;
        $this->save();
    }
}
