<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Redirector;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'task_text' => 'required|max:255',
            'userId' => 'required'
        ]);
        if ($validateData->fails()) {


            return Redirect::to('tasks/1')->with('message', 'add Task Failed');
        } else {
            // $imageName = $request->image->getClientOriginalName();
            // Storage::putFileAs('images', $request->image, $imageName);
            // $request->image->move(public_path('upload'), $imageName);
            $taskData = array('task_text' => $request->task_text, 'user_id' => $request->userId);
            Task::create($taskData);

            return Redirect::to('tasks/' . $request->userId);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tasks = Task::where('user_id', $id)->get();
        return view('home', compact('tasks', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Task::where('id', $id)->update(['task_text' => $request->task_text]);
        $userId = Task::select('user_id')->where('id', $id)->first();


        return Redirect::to('tasks/' . $userId['user_id'])->with('message', 'update Done Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userId = Task::select('user_id')->where('id', $id)->first();
        Task::where('id', $id)->delete();
        return Redirect::to('tasks/' . $userId['user_id']);
    }
    public function search(string $id, Request $request)
    {
        $tasks = Task::where('task_text', 'LIKE', '%' . $request->task_text . '%')->get();
        return view('home', compact('tasks'));;
    }

    public function changeStatus(string $taskId, string $userId)
    {
        $task = Task::find($taskId);
        $task->status = !$task->status;
        $task->save();
        return Redirect::to('tasks/' . $userId)->with('message', 'update Done Successfully');
    }
}
