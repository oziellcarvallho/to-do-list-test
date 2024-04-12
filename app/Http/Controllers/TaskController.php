<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the tasks.
     */
    public function index(Request $request)
    {
        $tasks = Task::when($request->has('q'), function($query) use ($request){
            $query->where(function ($builder) use ($request) {
                $builder->where('title', 'like', '%' . $request->q . '%')
                    ->orWhere('description', 'like', '%' . $request->q . '%');
            });
        })->orderBy('id', 'desc')->paginate(15);
    
        return view('task.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $task = null;
        $disabled = false;
        $users = User::where('id', '<>', 1)->get();

        return view('task.form', ['task' => $task, 'disabled' => $disabled, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $fields = $request->only([
            'title', 'description', 'status', 'users_id', 'responsible_id'
        ]);

        $responsible = User::findOrFail($fields['responsible_id']);
        $fields['responsible_email'] = $responsible->email;

        $task = Task::create($fields);
        $task->users()->attach($fields['users_id']);

        return redirect()->route('task.index')->with('flash_success', 'Usuário cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $disabled = true;
        $users = User::where('id', '<>', 1)->get();

        return view('task.form', ['task' => $task, 'disabled' => $disabled, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $disabled = false;
        $users = User::where('id', '<>', 1)->get();

        return view('task.form', ['task' => $task, 'disabled' => $disabled, 'users' => $users]);
    }

    /**
     * Update the specified task in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $fields = $request->only([
            'title', 'description', 'status', 'users_id', 'responsible_id'
        ]);
        
        $task->update($fields);
    }

    /**
     * Remove the specified task from storage.
     * 
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('task.index')->with('flash_success', 'Tarefa excluída com sucesso!');
    }
}
