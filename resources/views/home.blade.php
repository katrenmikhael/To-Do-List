@extends('layout.layout')
@section('content')
    <div class="table-sec">
        <div class="search">
            @if (count($tasks) > 0)
                <div class="d-none"> {{ $user_id = $tasks[0]->user_id }}</div>
            @else
                <div class="d-none">
                    {{ $user_id = 0 }}
                </div>
            @endif


            <form method="POST" id="searchForm" action="{{ url('/searchTasks/' . $user_id) }}">

                @csrf
                <div class="input-group">
                    <input type="text" id="searchText" name="task_text" class="form-control"
                        aria-label="Amount (to the nearest dollar)">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-dark"><span
                                class="input-group-text h-100 d-flex justify-content-between align-items-center  bg-dark text-white"><i
                                    class="fa fa-search" aria-hidden="true"></i></span></button>

                    </div>
                </div>

            </form>

        </div>

        <div class="table mt-5">
            <table class="table table-secondary table-striped text-center">
                <thead>
                    <tr class="fw-bold">
                        <td>#</td>
                        <td>Task</td>
                        <td>Status</td>
                        <td>Edit</td>
                        <td>Delete</td>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($tasks))
                        @foreach ($tasks as $task)
                            <tr>

                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $task->task_text }}</td>
                                <td>
                                    <a class="btn btn-outline-info py-2 "
                                        href="{{ url("tasks/status/$task->id/$user_id") }}">
                                        @if ($task->status == 0)
                                            <span class="">
                                                <i class="fa-solid fa-clock "></i>
                                            </span>
                                        @endif
                                        @if ($task->status == 1)
                                            <span class="">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            </span>
                                        @endif
                                    </a>
                                </td>
                                <td><button class="btn btn-outline-success" data-bs-toggle="modal"
                                        data-bs-target="#editTask"
                                        onclick="editTask({{ $task->id }})"><span>Edit</span></button></td>

                                <td><button class="btn btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteTask"
                                        onclick="deleteTask({{ $task->id }})"><span>Delete</span></button></td>

                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <div class="add-btn">

            @if (isset($message))
                <h1 class="" id="status">{{ $message }}</h1>
            @endif
            <!-- Add Task Modal -->
            <div class="modal fade" id="addTask" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header text-center bg-basic">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Task</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="{{ url('tasks') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-floating mb-3">
                                    <input type="text" name="task_text" class="form-control" id="floatingInput"
                                        placeholder="task text">

                                    <label for="floatingInput">Write Task</label>
                                </div>
                                <input type="hidden" name="userId" value="{{ $id }}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary text-dark"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="addTask text-dark taskBtn">Add Task</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addTask">
                Add Task
            </button>
        </div>


        <!-- edit Modal -->
        <div class="modal fade" id="editTask" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-basic">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Task</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="POST" id="editTask">
                        @csrf
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <input type="text" name="task_text" class="form-control" id="floatingInput"
                                    placeholder="task text">
                                <label for="floatingInput">Task</label>
                            </div>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary text-dark"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="editBtn" class="text-dark taskBtn">
                                Edit Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Delete Modal -->
        <div class="modal fade" id="deleteTask" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-basic">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Task</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        Are you sure to delete this task?
                    </div>
                    <form method="POST">

                        @csrf
                        <div class="modal-footer">
                            <button type="button" class="btn text-dark btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="deleteBtn" class="text-dark taskBtn">
                                Delete
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">

                <strong class="me-auto">notification</strong>

                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>

            </div>
            <div class="toast-body">
                @if (isset($message))
                    {{ $message }}
                @endif
            </div>
        </div>
    </div>


@stop
