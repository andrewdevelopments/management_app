@extends('layouts.app')


@section('content')
    <div class="row">

        <div class="col-8">

            <div class="content-box p-4">
                <h2 class="mb-4">{{ $project->project->name }}</h2>
                <p class="m-0">{{ $project->project->description }}</p>
            </div>

        </div>

        <div class="col-4">
            <div class="content-box p-4 d-flex align-items-center">

                <div class="user-image d-flex align-items-center justify-content-center mr-4" style="background: {{ $project->user->colour }}">
                    <span>{{ substr($project->user->name, 0, 1) }}</span>
                </div>

                <div class="user-info">
                    <h3 class="mb-0">{{ $project->user->name }}</h3>
                    <span class="position">Role: {{ $project->user->role }}</span>
                </div>

            </div>
        </div>

    </div>

    <div class="row mt-5">
        <div class="col-12">

            <div class="task-table p-4">

                @if($project->tasks)

                    <div class="task-runner row">

                        <div class="todo col-3">

                            <div class="runway p-3">

                                <div class="task-head">
                                    <h4 class="mb-4 pb-2">Todo</h4>
                                </div>

                                <div class="task-body">
                                    @foreach( $project->tasks as $task )
                                        @if($task->status == 'todo')

                                            <div class="task" onclick="openConstructor('{{ $task->id }}');">
                                                <h6 class="mb-2"><strong>{{ $task->name }}</strong></h6>

                                                <div class="task-user d-flex align-items-center justify-content-center" style="background: {{ $userTask->retrieveUserInformation($task->user_id)->colour }}" title="This task is assigned to {{ $userTask->retrieveUserInformation($task->user_id)->name }}">
                                                    {{ substr($userTask->retrieveUserInformation($task->user_id)->name, 0, 1) }}
                                                </div>

                                            </div>

                                        @endif
                                    @endforeach
                                    <div class="task-new">Add new task</div>
                                </div>

                            </div>

                        </div>

                        <div class="in-progress col-3">

                            <div class="runway p-3">

                                <div class="task-head">
                                    <h4 class="mb-4 pb-2">In Progress</h4>
                                </div>

                                <div class="task-body">
                                    @foreach( $project->tasks as $task )
                                        @if($task->status == 'in-progress')

                                            <div class="task" onclick="openConstructor('{{ $task->id }}');">
                                                <h6 class="mb-2"><strong>{{ $task->name }}</strong></h6>

                                                <div class="task-user d-flex align-items-center justify-content-center" style="background: {{ $userTask->retrieveUserInformation($task->user_id)->colour }}" title="This task is assigned to {{ $userTask->retrieveUserInformation($task->user_id)->name }}">
                                                    {{ substr($userTask->retrieveUserInformation($task->user_id)->name, 0, 1) }}
                                                </div>
                                            </div>

                                        @endif
                                    @endforeach
                                </div>

                            </div>

                        </div>

                        <div class="for-approval col-3">

                            <div class="runway p-3">

                                <div class="task-head">
                                    <h4 class="mb-4 pb-2">For Approval</h4>
                                </div>

                                <div class="task-body">
                                    @foreach( $project->tasks as $task )
                                        @if($task->status == 'for-approval')

                                            {{ $project->userTask }}

                                            <div class="task" onclick="openConstructor('{{ $task->id }}');">
                                                <h6 class="mb-2"><strong>{{ $task->name }}</strong></h6>

                                                <div class="task-user d-flex align-items-center justify-content-center" style="background: {{ $userTask->retrieveUserInformation($task->user_id)->colour }}" title="This task is assigned to {{ $userTask->retrieveUserInformation($task->user_id)->name }}">
                                                    {{ substr($userTask->retrieveUserInformation($task->user_id)->name, 0, 1) }}
                                                </div>
                                            </div>

                                        @endif
                                    @endforeach
                                </div>

                            </div>

                        </div>

                        <div class="done col-3">

                            <div class="runway p-3">

                                <div class="task-head">
                                    <h4 class="mb-4 pb-2">Done</h4>
                                </div>

                                <div class="task-body">
                                    @foreach( $project->tasks as $task )
                                        @if($task->status == 'done')

                                            <div class="task" onclick="openConstructor('{{ $task->id }}');">
                                                <h6 class="mb-2"><strong>{{ $task->name }}</strong></h6>

                                                <div class="task-user d-flex align-items-center justify-content-center" style="background: {{ $userTask->retrieveUserInformation($task->user_id)->colour }}" title="This task is assigned to {{ $userTask->retrieveUserInformation($task->user_id)->name }}">
                                                    {{ substr($userTask->retrieveUserInformation($task->user_id)->name, 0, 1) }}
                                                </div>
                                            </div>

                                        @endif
                                    @endforeach
                                </div>

                            </div>

                        </div>

                    </div>

                @endif

            </div>

        </div>
    </div>

    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script type="text/javascript">

        $(document).on('click', '.task-new', function() {
            newTask();
        });

        var editTask = function( target ) {

            var task_name = $('#name').val(),
                task_description = $('#description').val(),
                task_status = $('#status').val(),
                user_id = $('#user_id').val(),
                task_important = $('#important').val(),
                task_due_date = $('#due_date').val();

            if( '{{ $user->role == 'Admin' }}' ) {
                $.ajax({
                    url: '/task/' + target,
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: task_name,
                        description: task_description,
                        status: task_status,
                        user_id: user_id,
                        important: task_important,
                        due_date: task_due_date,
                        id: target,
                        projects_id: '{{ $project->id }}',
                    },
                    success: function (data) {
                        console.log(data);
                        window.location.reload();
                        // constructor( data );
                    }
                });
            }
            else {
                alertMessage();
            }

        },
        newTask = function() {

            if( '{{ $user->role == 'Admin' }}' ) {
                constructor('post');
            }
            else {
                alertMessage();
            }

        },
        saveNewTask = function() {

            var task_name = $('#name').val(),
                task_description = $('#description').val(),
                task_status = $('#status').val(),
                task_important = $('#important').val(),
                user_id = $('#user_id').val(),
                task_due_date = $('#due_date').val();

            console.log(task_important)

            $.ajax({
                url: '/task',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: task_name,
                    description: task_description,
                    status: task_status,
                    due_date: task_due_date,
                    user_id: user_id,
                    important: task_important,
                    projects_id: '{{ $project->id }}',
                    owner: '{{ $user->id }}'
                },
                success:function(data) {
                    console.log(data)
                    window.location.reload();
                }
            });

        },
        openConstructor = function(id) {

            $.ajax({
                url: '/task/' + id,
                type: 'GET',
                dataType: 'json',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success:function(data) {
                    console.log(data);
                    constructor( data );
                }
            });

        },
        constructor = function( data = '' ) {

            var selected, button, hide, users;

            var id = data.id ? data.id : '';
            var name = data.name ? data.name : '';
            var description = data.description ? data.description : '';
            var user_id = data.user_id ? data.user_id : '';
            var owner = data.owners ? data.owners[0].name : '';
            var type = data == 'post' ? true : false;


            var due_date = data.due_date ? data.due_date : '';
            var date = new Date(due_date);
            // var fullDate = date.getMonth() + 1 + '/' + date.getDate() + '/' + date.getFullYear();
            var fullDate = date.getFullYear() + '-0' + (date.getMonth() + 1) + '-' + date.getDate();

            if(type) {
                hide = 'style="display:none"';
                button = '<a href="javascript:void(0);" onclick="saveNewTask()" class="btn btn-primary">Save</a></div>';
            }
            else {
                hide = '';
                button = '<a href="javascript:void(0);" onclick="editTask('+ id +')" class="btn btn-primary">Save</a></div>';
            }

            $('<div class="modal d-flex align-items-center justify-content-center">\n' +
                '        <div class="modal-inner">\n' +
                '\n' +
                '            <div class="modal-header">\n' +
                '                <h4>Edit task</h4>\n' +
                '            </div>\n' +
                '\n' +
                '            <div class="modal-body p-4">\n' +
                '\n' +
                '                <div class="form-group">\n' +
                '                    <label for="name">Task name</label>\n' +
                '                    <input type="text" id="name" name="name" value="'+ name +'" class="form-control">\n' +
                '                </div>\n' +
                '\n' +
                '                <div class="form-group">\n' +
                '                    <label for="description">Description</label>\n' +
                '                    <textarea name="description" id="description" rows="5" class="form-control">'+ description +'</textarea>\n' +
                '                </div>\n' +
                '\n' +
                '                <div class="form-group">\n' +
                '                    <label for="status">Status</label>\n' +
                '                    <select name="status" id="status" class="form-control">\n' +
                '                        <option value="todo">Todo</option>\n' +
                '                        <option value="in-progress">In Progress</option>\n' +
                '                        <option value="for-approval">For Approval</option>\n' +
                '                        <option value="done">Done</option>\n' +
                '                    </select>\n' +
                '                </div>\n' +
                '\n' +

                '<div class="form-group">\n' +
        '                    <label for="user_id">User</label>\n' +
        '                    <select name="user_id" id="user_id" class="form-control">\n' +
                '@foreach($all as $users)' +
            '                        <option value="{{ $users->id }}">{{ $users->name }} - {{ $users->role }}</option>\n' +
                '@endforeach' +
            '                    </select>\n' +
        '                </div>\n' +
                '                <div class="form-group">\n' +
                '                    <label for="important">Importance</label>\n' +
                '                    <select name="important" id="important" class="form-control">\n' +
                '                        <option value="0">Urgent</option>\n' +
                '                        <option value="1">For Later</option>\n' +
                '                        <option value="2">Not Urgent</option>\n' +
                '                    </select>\n' +
                '                </div>\n' +
                '\n' +
                '                <div class="form-group">\n' +
                '                    <label for="due_date">Due Date</label>\n' +
                '                    <input type="date" id="due_date" name="due_date" value="'+ fullDate +'" class="form-control">\n' +
                '                </div>\n' +
                '\n' +
                '                <div class="form-group" '+ hide +'>\n' +
                '                    <label for="owner">Owner</label>\n' +
                '                    <input type="text" class="form-control" readonly value="'+ owner +'">\n' +
                '                </div>\n' +
                '\n' +
                '            </div>\n' +
                '<div class="modal-footer justify-content-between"><a href="javascript:void(0);" onclick="destroyConstructor()" class="btn btn-danger">Close</a>' + button +
                '        </div>\n' +
                '    </div>').appendTo('body');



            $('select#status').val(data.status);
            $('select#important').val(data.important);
            $('select#user_id').val(data.user_id);

        },
        alertMessage = function() {
            alert('Ooops! You dont have permission to this functionality.');
        },
        destroyConstructor = function() {
            $('.modal').remove();
        };

    </script>

@endsection
