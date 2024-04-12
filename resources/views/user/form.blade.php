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
    <br>
    <form action="{{ !is_object($user) ? route('user.store') : route('user.update', $user) }}" class="needs-validation" method="POST" id="{{ !is_object($user) ? 'create' : 'update' }}-user">
        @csrf
        @isset($user)
            @method('PUT')
        @endisset

        <div class="row g-3">
            <div class="col-sm-6">
                <label for="name" class="form-label">Nome</label>
                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="" value="{{ old('name', $user->name ?? null) }}" required @if($disabled) disabled @endif>
                @error('name')
                    <div style="color: #dc3545;">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-6">
                <label for="email" class="form-label">Email</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="you@example.com" value="{{ old('email', $user->email ?? null) }}" required @if($disabled) disabled @endif>
                @error('email')
                    <div style="color: #dc3545;">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row g-3">
            <div class="col-sm-6">
                <label for="password" class="form-label">Senha</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="" @if(!is_object($user)) required @endif @if($disabled) disabled @endif>
                @error('password')
                    <div style="color: #dc3545;">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-6">
                <label for="password-confirmation" class="form-label">Confirmar Senha</label>
                <input name="password_confirmation" type="password" class="form-control" id="password-confirmation" placeholder="" @if(!is_object($user)) required @endif @if($disabled) disabled @endif>
                @error('password_confirmation')
                    <div style="color: #dc3545;">
                        {{ $message }}
                    </div>
                @enderror
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