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
        <div class="row g-3">
            <div class="col-sm-6">
                <label for="title" class="form-label">Titulo</label>
                <input name="title" type="text" class="form-control" id="title" placeholder="" value="" required>
                @error('title')
                    <div style="color: #dc3545;">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-sm-6">
                <label for="description" class="form-label">Descrição</label>
                <input name="description" type="text" class="form-control" id="description" placeholder="" value="" required>
                @error('description')
                    <div style="color: #dc3545;">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="users" class="form-label">Usuários</label>
                <select name="users_id[]" class="form-select" id="users" multiple required>
                    <option value="">Choose...</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected(old('version') == $user->id)>
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
                        <option value="{{ $user->id }}" @selected(old('version') == $user->id)>
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
        </div>

        <hr class="my-4">
        <button class="w-100 btn btn-primary btn-lg" type="submit">Salvar</button>
    </form>       
@endsection

@section('scripts')
@endsection