<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Gate::forUser(Auth::user())->denies('user-view')) {
            return abort(403);
        }

        $users = User::when($request->has('q'), function($query) use ($request){
            $query->where(function ($builder) use ($request) {
                $builder->where('nome', 'like', '%' . $request->q . '%')
                    ->orWhere('email', 'like', '%' . $request->q . '%');
            });
        })
        ->where('id', '<>', 1)
        ->orderBy('id', 'desc')->paginate(15);
    
        return view('user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::forUser(Auth::user())->denies('user-create')) {
            return abort(403);
        }

        $user = null;
        $disabled = false;

        return view('user.form', ['user' => $user, 'disabled' => $disabled]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        if (Gate::forUser(Auth::user())->denies('user-create')) {
            return abort(403);
        }

        $fields = $request->only([
            'name', 'email'
        ]);

        $fields['password'] = Hash::make($request->password);
        
        User::create($fields);

        return redirect()->route('user.index')->with('flash_success', 'Usuário cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if (Gate::forUser(Auth::user())->denies('user-view')) {
            return abort(403);
        }

        $disabled = true;

        return view('user.form', ['user' => $user, 'disabled' => $disabled]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (Gate::forUser(Auth::user())->denies('user-edit')) {
            return abort(403);
        }

        $disabled = false;

        return view('user.form', ['user' => $user, 'disabled' => $disabled]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if (Gate::forUser(Auth::user())->denies('user-edit')) {
            return abort(403);
        }

        $fields = $request->only([
            'name', 'email'
        ]);
        
        if ($request->has('password')) {
            $fields['password'] = Hash::make($request->password);
        }
        
        $user->update($fields);

        return redirect()->route('user.index')->with('flash_success', 'Usuário editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (Gate::forUser(Auth::user())->denies('user-delete')) {
            return abort(403);
        }

        $user->delete();

        return redirect()->route('user.index')->with('flash_success', 'Usuário excluído com sucesso!');
    }
}
