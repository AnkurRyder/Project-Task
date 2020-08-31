<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class team extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function Create(string $id, string $name) {
        $this->id = $id;
        $this->name = $name;
        $this->save();
    }
}
