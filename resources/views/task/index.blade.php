@extends('layout.app')

@section('title', 'Tarefas')

@section('styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <form action="{{ route('task.index') }}" method="GET" id="serach" role="search">
                <div class="row">
                    <div class="col-sm-6">
                        <input name="q" type="search" class="form-control" placeholder="Buscar" value="{{ request()->get('q') }}" aria-label="Search">
                    </div>
                    <div class="col-sm-6">
                        <select name="status" class="form-select">
                            <option value="">Status</option>
                            @foreach (config('utils.status') as $key => $status)
                                <option value="{{ $key }}" @selected(request()->get('status') == $key)>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-6">
            <div class="col-xs-12 d-flex justify-content-end">
                @can('task-create')
                    <a class="btn btn-primary" href="{{ route('task.create') }}" role="button">Criar Tarefa</a>
                @endcan
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
                <th scope="col">Email do Responsável</th>
                <th scope="col">Data de Criação</th>
                <th scope="col" class="d-flex justify-content-end">Ação</th>
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
                    <td>{{ $task->responsible_email }}</td>
                    <td>{{ $task->created_at->format('d/m/Y à\s H:i:s') }}</td>
                    <td class="d-flex justify-content-end" style="gap: 5px">
                        @can('task-view')
                            <a href="{{ route('task.show', $task) }}" class="btn btn-info" role="button">Ver</a>
                        @endcan
                        @can('task-edit')
                            <a href="{{ route('task.edit', $task) }}" class="btn btn-warning" role="button">Editar</a>
                        @endcan
                        @can('task-delete')
                            <form method="POST" action="{{ route('task.destroy', $task) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" role="button">Excluir</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center">Nenhuma tarefa encontrada!</td>
                </tr>
            @endforelse
        </tbody>
    </table> 
@endsection

@section('scripts')
@endsection