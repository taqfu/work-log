<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\LogEntry;
use App\RoutineType;
use App\Routine;
use App\Tag;
use App\TagType;
use App\Incident;
use DB;
use View;
class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        if (count(Tag::where('type_id', $request->newTagType)
          ->where('log_entry_id', $request->logEntryID)->get())>0){
            return back()->withErrors("Log entry is already tagged with this.");
        }
        $tag = new Tag;
        $tag->type_id = $request->newTagType;
        $tag->log_entry_id = $request->logEntryID;
        
        if ($request->incidentID != 0){
            $tag->incident_id = $request->incidentID;
        } else if ($request->routineID != 0){
            $tag->routine_id = $request->routineID;
        }
        $tag->save();
        if ($request->route=="/"){
            return redirect(env('APP_URL') . "$request->route/#entry".$request->logEntryID);
        } 
        return redirect(route($request->route)."#".$request->logEntryID);
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
    public function destroy(Request $request, $id)
    {
        $tag = new Tag;
        $tag->where("id", $id)->delete();
        if ($request->route=="/"){
            return redirect(env('APP_URL') . "$request->route/#entry".$request->logEntryID);
        } 
        return redirect(route($request->route)."#".$request->logEntryID);
    }
}
