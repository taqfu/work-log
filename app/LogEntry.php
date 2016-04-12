<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogEntry extends Model
{
    use SoftDeletes;
    protected $dates =["deleted_at"];

    public function incident(){
        return $this->belongsTo("App\Incident");
    }
     
    public function routine(){
        return $this->belongsTo("App\Routine");
    }
}
