@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Tasks') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="daterange mb-5">
                        <form method="get">
                            <div class="form-group">
                                <label for="start_date">Start date</label>
                                <input type="text" class="form-control date" autocomplete="off" name="start_date" id="start_date" value="{{ $start_date }}">
                            </div>
                            <div class="form-group">
                                <label for="end_date">End date</label>
                                <input type="text" class="form-control date" autocomplete="off" name="end_date" id="end_date" value="{{ $end_date }}">
                            </div>
                            <div class="form-group">
                                <label for="end_date">Importance</label>
                                <select name="important" id="important" class="form-control">
                                    <option value="0" @if($important == 0) selected @endif>Urgent</option>
                                    <option value="1" @if($important == 1) selected @endif>For Later</option>
                                    <option value="2" @if($important == 2) selected @endif>Not Urgent</option>
                                </select>
                            </div>
                            <div class="text-right">
                                <button class="btn btn-default mr-4 clear-filter">Clear filter</button>
                                <button class="btn btn-primary">Filter</button>
                            </div>
                        </form>
                    </div>

                    @if($user->role == 'Admin')
                        <p>You have created the following tasks:</p>
                        <table class="table w-100 table-striped">
                            <thead>
                                <tr>
                                    <td>Task name</td>
                                    <td>Status</td>
                                    <td>Importance</td>
                                    <td>Due Date</td>
                                    <td>Assigned To</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            @foreach( $tasks as $task )
                                @if( $user->id == $task->owner )

                                    <tr>
                                        <td>
                                            <a href="/project/{{ $task->projects_id }}">{{ $task->name }}</a>
                                        </td>
                                        <td>
                                            @if($task->status == 'todo')
                                                To Do
                                            @elseif($task->status == 'in-progress')
                                                In Progress
                                            @elseif($task->status == 'for-approval')
                                                For Approval
                                            @elseif($task->status == 'done')
                                                Done
                                            @endif
                                        </td>
                                        <td>
                                            @if($task->important == 0)
                                                Urgent
                                            @elseif($task->important == 1)
                                                For Later
                                            @elseif($task->important == 2)
                                                Not Urgent
                                            @endif
                                        </td>
                                        <td>
                                            <span>{{ $task->due_date }}</span>
                                        </td>
                                        <td>
                                            {{ $userTask->retrieveUserInformation($task->user_id)->name }}
                                        </td>
                                        <td>
                                            <button class="btn btn-danger btn-sm remove-task" onclick="removeTask('{{ $task->id }}')">Remove</button>
                                        </td>
                                    </tr>

                                @endif
                            @endforeach
                        </table>
                    @endif

                    <p>These tasks are assigned to you:</p>
                        <table class="table w-100 table-striped">
                            <thead>
                            <tr>
                                <td>Task name</td>
                                <td>Status</td>
                                <td>Importance</td>
                                <td>Due Date</td>
                                <td>Assigned To</td>
                            </tr>
                            </thead>
                            @foreach( $tasks as $task )
                                @if( $user->id == $task->user_id )

                                    <tr>
                                        <td>
                                            <a href="/project/{{ $task->projects_id }}">{{ $task->name }}</a>
                                        </td>
                                        <td>
                                            @if($task->status == 'todo')
                                                To Do
                                            @elseif($task->status == 'in-progress')
                                                In Progress
                                            @elseif($task->status == 'for-approval')
                                                For Approval
                                            @elseif($task->status == 'done')
                                                Done
                                            @endif
                                        </td>
                                        <td>
                                            @if($task->important == 0)
                                                Urgent
                                            @elseif($task->important == 1)
                                                For Later
                                            @elseif($task->important == 2)
                                                Not Urgent
                                            @endif
                                        </td>
                                        <td>
                                            {{ $task->due_date }}
                                        </td>
                                        <td>
                                            {{ $userTask->retrieveUserInformation($task->user_id)->name }}
                                        </td>
                                    </tr>

                                @endif
                            @endforeach
                        </table>

                </div>
            </div>
        </div>
    </div>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

    <script type="text/javascript">

        $('.date').datepicker({
            format: 'yyyy-mm-dd'
        });


        $('.clear-filter').on('click', function() {
            window.location = window.location.origin + window.location.pathname;
            return false;
        });

        var removeTask = function(id) {

            $.ajax({
                url: '/task/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success:function(data) {
                    window.location.reload();
                }
            });

        };

    </script>

@endsection
