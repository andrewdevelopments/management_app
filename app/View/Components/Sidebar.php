<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Sidebar extends Component
{

    public $projects;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get projects name and slug for sidebar
     * @return object
     * */
    public function projects() : object {
        return \App\ProjectsUser::orderBy('id', 'asc')->with('user', 'project')->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {

        if(\Auth::user()) {
            return view('components.sidebar');
        }
    }
}
