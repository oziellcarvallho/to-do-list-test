@extends('layout.app')

@if(!is_object($user))
    @section('title', 'Criar Usuário')
@elseif(!$disabled)
    @section('title', 'Editar Usuário')
@else
    @section('title', 'Ver Usuário')
@endif

@section('styles')
@endsection

@section('content')
    <br>
    <h4>Usuário</h4>
    {{ $errors }}
    <br>
    <form action="{{ !is_object($user) ? route('user.store') : route('user.update', $user) }}" class="needs-validation" method="{{ !is_object($user) ? 'POST' : 'PUT' }}" id="{{ !is_object($user) ? 'create' : 'update' }}-user">
        @csrf
        <div class="row g-3">
            <div class="col-sm-6">
                <label for="name" class="form-label">Nome</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="" value="{{ $user->name }}" required @if($disabled) disabled @endif>
                
                <div class="invalid-feedback">
                    Valid first name is required.
                </div>
            </div>
            <div class="col-6">
                <label for="email" class="form-label">Email</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="you@example.com" value="{{ $user->email }}" required @if($disabled) disabled @endif>
                
                <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                </div>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-sm-6">
                <label for="password" class="form-label">Senha</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="" required @if($disabled) @endif>
                
                <div class="invalid-feedback">
                    Valid first name is required.
                </div>
            </div>
            <div class="col-6">
                <label for="password-confirmation" class="form-label">Confirmar Senha</label>
                <input name="password_confirmation" type="password" class="form-control" id="password-confirmation" placeholder="" @if($disabled) disabled @endif>
                
                <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                </div>
            </div>
        </div>
        <hr class="my-4">
        @if(!$disabled)
            <button class="w-100 btn btn-primary btn-lg" type="submit">Salvar</button>
        @endif
    </form>
@endsection

@section('scripts')
@endsection