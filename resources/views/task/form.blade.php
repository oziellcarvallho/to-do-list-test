@extends('layout.app')

@if(!is_object($task))
    @section('title', 'Criar Tarefa')
@elseif(!$disabled)
    @section('title', 'Editar Tarefa')
@else
    @section('title', 'Ver Tarefa')
@endif

@section('styles')
@endsection

@section('content')
    <form action="{{ !is_object($task) ? route('task.store') : route('task.update', $task) }}" class="needs-validation" method="POST" id="{{ !is_object($task) ? 'create' : 'update' }}-task">
        @csrf
        @isset($task)
            @method('PUT')
        @endisset
        <div class="row">
            <div class="col-sm-6">
                <label for="title" class="form-label">Titulo</label>
                <input name="title" type="text" class="form-control" id="title" placeholder="" value="{{ old('title', $task->title ?? null) }}" required>
                @error('title')
                    <div style="color: #dc3545;">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-sm-6">
                <label for="description" class="form-label">Descrição</label>
                <input name="description" type="text" class="form-control" id="description" placeholder="" value="{{ old('description', $task->description ?? null) }}" required>
                @error('description')
                    <div style="color: #dc3545;">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-12">
                <label for="users" class="form-label">Usuários</label>
                <select name="users_id[]" class="form-select" id="users" multiple required>
                    <option value="">Choose...</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected(in_array($user->id, old('users_id[]', $task->users->pluck('id')->toArray())))>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                @error('users_id')
                    <div style="color: #dc3545;">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="responsible" class="form-label">Responsável</label>
                <select name="responsible_id" class="form-select" id="responsible" required>
                    <option value="">Choose...</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected(old('responsible_id', $task->responsible_id ?? null) == $user->id)>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                @error('responsible_id')
                    <div style="color: #dc3545;">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-select" id="status" required>
                    <option value="">Choose...</option>
                    @foreach (config('utils.status') as $key => $status)
                        <option value="{{ $key }}" @selected(old('status', $task->status ?? null) == $key)>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
                @error('status')
                    <div style="color: #dc3545;">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <hr class="my-4">
        <button class="w-100 btn btn-primary btn-lg" type="submit">Salvar</button>
    </form>       
@endsection

@section('scripts')
@endsection