@extends('layout.app')

@section('title', 'Usuários')

@section('styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <form role="search">
                <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
            </form>
        </div>
        <div class="col-sm-6">
            <div class="col-xs-12 d-flex justify-content-end">
                <a href="{{ route('user.create') }}" class="btn btn-primary" role="button">Criar Usuário</a>
            </div>
        </div>
    </div>
    <br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <th scope="row">{{ $user->name }}</th>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('user.show', $user) }}" class="btn btn-info" role="button">Ver</a>
                        <a href="{{ route('user.edit', $user) }}" class="btn btn-warning" role="button">Editar</a>
                        <a href="{{ route('user.destroy', $user) }}" class="btn btn-danger" role="button">Excluir</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center">Nenhuma tarefa encontrada!</td>
                </tr>
            @endforelse
        </tbody>
    </table> 
@endsection

@section('scripts')
@endsection