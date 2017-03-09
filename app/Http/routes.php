<?php
use \App\LogEntry;
use \App\RoutineType;
use \App\Routine;
use \App\Tag;
use \App\TagType;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', ["as"=>"today", function () {
    $today = date ("Y-m-d");
    $end_date = "$today 23:59:59";
    $begin_date = "$today 00:00:00";
    return view('main' , [
        "routine_types" => RoutineType ::orderBy("name", "asc")-> get(),
        "log_entries" => LogEntry :: where('when', '<', $end_date)
          ->where('when', '>', $begin_date)
          ->orderBy("when", "desc")->get(),
        "routines" => Routine :: orderBy("when", "desc")->get(),
        "tag_types" => TagType :: orderBy("name", "asc")->get(),
        "tags" => Tag :: orderBy("created_at", "asc")->get(),
        'period'=>'today',
   ]);
}]);

Route::get('/yesterday', ["as"=>"yesterday", function () {
    $yesterday = date('Y-m-d',strtotime("-1 days"));
    $end_date = "$yesterday 23:59:59";
    $begin_date = "$yesterday 00:00:00";
    return view('main' , [
        "routine_types" => RoutineType ::orderBy("name", "asc")-> get(),
        "log_entries" => LogEntry :: where('when', '<', $end_date)
          ->where('when', '>', $begin_date)
          ->orderBy("when", "desc")->get(),
        "routines" => Routine :: orderBy("when", "desc")->get(),
        "tag_types" => TagType :: orderBy("name", "asc")->get(),
        "tags" => Tag :: orderBy("created_at", "asc")->get(),
        'period'=>'yesterday',
   ]);
}]);
Route::get('/shifts', ['as'=>'shifts', function(){
    return View('shifts', [
        'routines'=>Routine::orWhere('type_id', 2)->orWhere('type_id', 12)
          ->orderBy('when', 'desc')->get(),
    ]);
}]);

Route::resource('incident', 'IncidentController');
Route::resource('log', 'LogEntryController');
Route::resource('RoutineType', 'RoutineTypeController');
Route::resource('routine', 'RoutineController');
Route::resource('tag', 'TagController');
Route::resource('TagType', 'TagTypeController');
