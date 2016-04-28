<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Tag extends Model
{
    use SoftDeletes;
    protected $dates =["deleted_at"];

    public function type(){
        return $this->belongsTo("App\TagType");
    }
    public function log_entries(){
        return $this->belongsTo("App\LogEntry", "log_entry_id");
    }
}
