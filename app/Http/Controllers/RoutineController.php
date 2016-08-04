<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Routine;
use App\LogEntry;
class RoutineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $routine = new Routine;
        if ($request->timestamp=="now"){
            $when = date("Y-m-d H:i:s");
        } else if ($request->timestamp!="now"){
            $when = $request->timestamp;
        }   
        $routine->when = $when;
        $routine->type_id =  $request->id;
        $routine->save();
        $log = new LogEntry;
        $log->when  = $when;
        $log->routine_id = $routine->id;
        $log->save();
        return redirect(redirect()->getUrlGenerator()->previous());
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
        Routine :: where("id", $id)->delete();
        return redirect(redirect()->getUrlGenerator()->previous());
    }

}
