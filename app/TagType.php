<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TagType extends Model
{
    use SoftDeletes;
    protected $dates =["deleted_at"];

    public function tag(){
        return $this->hasMany("App\Tag", "type_id")->orderBy('created_at', 'desc');
    }
}
