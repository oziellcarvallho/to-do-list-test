<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    /**
     * Display a listing of the tasks.
     */
    public function index(Request $request)
    {
        if (Gate::forUser(Auth::user())->denies('task-view')) {
            return abort(403);
        }

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
        if (Gate::forUser(Auth::user())->denies('task-create')) {
            return abort(403);
        }

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
        if (Gate::forUser(Auth::user())->denies('task-create')) {
            return abort(403);
        }

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
        if (Gate::forUser(Auth::user())->denies('task-view')) {
            return abort(403);
        }

        $disabled = true;
        $users = User::where('id', '<>', 1)->get();

        return view('task.form', ['task' => $task, 'disabled' => $disabled, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        if (Gate::forUser(Auth::user())->denies('task-edit')) {
            return abort(403);
        }

        $disabled = false;
        $users = User::where('id', '<>', 1)->get();

        return view('task.form', ['task' => $task, 'disabled' => $disabled, 'users' => $users]);
    }

    /**
     * Update the specified task in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        if (Gate::forUser(Auth::user())->denies('task-edit')) {
            return abort(403);
        }

        $fields = $request->only([
            'title', 'description', 'status', 'users_id', 'responsible_id'
        ]);
        
        $responsible = User::findOrFail($fields['responsible_id']);
        $fields['responsible_email'] = $responsible->email;

        $task->update($fields);
        $task->users()->sync($fields['users_id']);

        return redirect()->route('task.index')->with('flash_success', 'Tarefa editada com sucesso!');
    }

    /**
     * Remove the specified task from storage.
     * 
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if (Gate::forUser(Auth::user())->denies('task-delete')) {
            return abort(403);
        }

        $task->delete();

        return redirect()->route('task.index')->with('flash_success', 'Tarefa excluída com sucesso!');
    }
}
