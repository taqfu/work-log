<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Incident extends Model
{
    use SoftDeletes;
    protected $dates =["deleted_at"];
   
    public function logEntry(){
        return $this->hasOne('App\LogEntry');
    }
    public function tags(){
        return $this->hasMany("App\Tag");
    }
}
