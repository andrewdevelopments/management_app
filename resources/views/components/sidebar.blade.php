
<aside id="sidebar">
    <div class="sidebar-header"></div>
    <div class="sidebar-body">
        <ul class="list-unstyled m-0">
            @foreach( $projects as $project )
                <li>
                    <a href="{{ url('project/' . $project->project->id) }}" title="Project started by {{ $project->user->name }}">
                        <span class="image-round d-flex align-items-center justify-content-center float-left mr-4" style="background: {{ $project->user->colour }}">
                            {{ substr($project->user->name, 0, 1) }}
                        </span>
                        <span>
                            {{ $project->project->name }} <br>
                            <small>Started: {{ $project->project->created_at->format('d-m-Y') }}</small>
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</aside>
