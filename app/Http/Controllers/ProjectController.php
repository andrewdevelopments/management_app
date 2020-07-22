<?php

namespace App\Http\Controllers;

use App\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Event\RequestEvent;


class ProjectController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function retrieveUserInformation( $id ) {
        return \App\User::findOrFail($id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


            $startDate = request()->input('start_date');
            $endDate = request()->input('end_date');
            $important = request()->input('important');

            if(request()->input('start_date') && request()->input('end_date')) {
                $tasks = \App\Tasks::with('users')->where('important', '=', $important)->whereBetween('due_date', [$startDate, $endDate])->get();
            }
            else {
                $tasks = \App\Tasks::with('users')->get();
            }

        $user = Auth::user();

        //dd($tasks);

        return view('projects')->with(['tasks' => $tasks, 'user' => $user, 'start_date' => $startDate, 'end_date' => $endDate, 'important' => $important, 'userTask' => new ProjectController()]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = \App\ProjectsUser::where('id', $id)->with('user', 'project', 'tasks')->first();

        $all = \App\User::where('role', '!=', 'admin')->get();

        $user = Auth::user();

        //dd($all);

        return view('project.index')->with(['project' => $project, 'user' => $user, 'all' => $all, 'userTask' => new ProjectController()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo 'edit';
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
        //
    }
}
