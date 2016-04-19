<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\LogEntry;
use App\RoutineType;
use App\Routine;
use App\Tag;
use App\TagType;
use App\Incident;
use DB;
use View;
class LogEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
    return View :: make('main', [
        "log_entries" => LogEntry ::orderBy("when", "desc")->get(),
        "routines" => Routine :: orderBy("when", "desc")->get(),
        "routine_types" => RoutineType ::orderBy("name", "asc")-> get(),
        "tag_types" => TagType :: orderBy("name", "asc")->get(),
        "tags" => Tag :: orderBy("created_at", "asc")->get()
        
   ]);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // This is done under the RoutineController and IncidentController
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = DB::table('log_entries')->where("id", $id)->first();
        if ($row->routine_id!=0){
            $routine = new Routine;
            $routine->where("id",$row->routine_id)->delete();
        }

        $log_entry = new LogEntry;
        $log_entry->where("id", $id)->delete();
        return redirect ("/");
    }
}
