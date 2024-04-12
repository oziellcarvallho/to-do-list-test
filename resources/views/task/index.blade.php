@extends('layout.app')

@section('title', 'Tarefas')

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
                <a class="btn btn-primary" href="{{ route('task.create') }}" role="button">Criar Tarefa</a>
            </div>
        </div>
    </div>
    <br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Título</th>
                <th scope="col">Descrição</th>
                <th scope="col">Status</th>
                <th scope="col">Usuários</th>
                <th scope="col">Email do Responsável</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tasks as $task)
                <tr>
                    <th scope="row">{{ $task->title }}</th>
                    <td>{{ $task->description }}</td>
                    <td>
                        @switch($task->status)
                            @case('not_completed')
                            <span class="badge rounded-pill bg-danger">Não Concluído</span>
                                @break
                            @case('completed')
                                <span class="badge rounded-pill bg-success">Concluído</span>
                                @break
                            @default
                                <span class="badge rounded-pill bg-secondary">Indefinido</span>
                        @endswitch
                    </td>
                    <td>
                        @foreach($task->users as $user)
                            {{ $user->name }}<br>
                        @endforeach
                    </td>
                    <td>{{ $task->responsible_email }}</td>
                    <td>
                        <a href="{{ route('task.show', $task) }}" class="btn btn-info" role="button">Ver</a>
                        <a href="{{ route('task.edit', $task) }}" class="btn btn-warning" role="button">Editar</a>
                        <form method="POST" action="{{ route('task.destroy', $task) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" role="button">Excluir</button>
                        </form>
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