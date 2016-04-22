<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Routine extends Model
{
    use SoftDeletes;
    protected $dates =["deleted_at"];

    public function logEntry(){
        return $this->hasOne("App\LogEntry");
    }
    public function type(){
        return $this->belongsTo("App\RoutineType");
    }
    public function tags(){
        return $this->hasMany("App\Tag");
    }
}
