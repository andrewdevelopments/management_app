<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TasksController extends Controller
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

        $task = \App\Tasks::create([
            'name' => $request->name,
            'description' => $request->description ? $request->description : '',
            'status' => $request->status,
            'due_date' => $request->due_date,
            'projects_id' => $request->projects_id,
            'important' => $request->important,
            'user_id' => $request->user_id,
            'owner' => $request->owner,
        ]);

        return response()->json($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return \App\Tasks::with('users', 'owners')->find($id);

        //dd(\App\Tasks::find($id)->with('users'));
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
        $task = \App\Tasks::updateOrCreate(
        [ 'id' => $request->id ],
        [
            'name' => $request->name,
            'description' => $request->description ? $request->description : '',
            'status' => $request->status,
            'due_date' => $request->due_date,
            'important' => $request->important,
            'user_id' => $request->user_id,
            'projects_id' => $request->projects_id,
        ]);

        return response()->json($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\Tasks::find($id)->delete();
    }
}
