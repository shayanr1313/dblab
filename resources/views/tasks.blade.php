@extends('layouts.app')

@section('content')
    <!-- <div class="container"> -->
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Task
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Task Form -->
                    <form action="{{ url('task')}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Task Name -->
                        <div class="form-group">

                            <label for="task-list" class="col-sm-3 control-label">List</label>
                            <div class="col-sm-7">
                                <input type="text" name="list" id="task-list" class="form-control" value="{{ old('list') }}">
                            </div>

                            <label for="task-name" class="col-sm-3 control-label">Task</label>
                            <div class="col-sm-7">
                                <input type="text" name="name" id="task-name" class="form-control" value="{{ old('task') }}">
                            </div>

                            <label for="task-text" class="col-sm-3 control-label">Text</label>

                            <div class="col-sm-7">
                                <input type="text" name="text" id="task-text" class="form-control" value="{{ old('text') }}">
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Task
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Tasks -->
            @if (count($tasks) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <!-- Select List -->
                        @foreach ($tlist as $task)
                            <a href="{{ url('task/'.$task->list) }}"><button>{{ $task->list }}</button></a>
                        @endforeach
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>List</th>
                                <th>Task</th>
                                <th>Text</th>
                                <th></th>
                                <th>Edit list</th>
                                <th></th>
                                <th>Edit text</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="table-text"><div>{{ $task->list }}</div></td>
                                        <td class="table-text"><div>{{ $task->name }}</div></td>
                                        <td class="table-text"><div>{{ $task->text }}</div></td>

                                        <!-- Task Delete Button -->
                                        <td>
                                            <form action="{{ url('task/'.$task->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn"></i>Del
                                                </button>
                                            </form>
                                        </td>

                                        <td>
                                            <form action="{{ url('task/updateList/'.$task->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                <!-- {{ method_field('UPDATE') }} -->
                                                    <input type="text" name="list" id="task-text" class="form-control" value="">
                                                </td>
                                                <td>
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa fa-btn"></i>U list
                                                    </button>
                                            </form>
                                        </td>

                                        <td>
                                            <form action="{{ url('task/updateText/'.$task->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            <!-- {{ method_field('UPDATE') }} -->
                                                <input type="text" name="text" id="task-text" class="form-control" value="">
                                            <td>
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn"></i>U text
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    <!-- </div> -->
@endsection