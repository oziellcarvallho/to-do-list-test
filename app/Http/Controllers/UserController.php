<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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
        $user = null;
        $disabled = false;

        return view('user.form', ['user' => $user, 'disabled' => $disabled]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
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
        $disabled = true;

        return view('user.form', ['user' => $user, 'disabled' => $disabled]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $disabled = false;

        return view('user.form', ['user' => $user, 'disabled' => $disabled]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
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
        $user->delete();

        return redirect()->route('user.index')->with('flash_success', 'Usuário excluído com sucesso!');
    }
}
