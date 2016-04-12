<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RoutineType extends Model
{
    use SoftDeletes;
    protected $dates =["deleted_at"];
    public function routine(){
        return $this->hasMany("App\Routine");
    }
}
