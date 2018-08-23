@extends('adminlte::page')

@section('title', 'Histórico')

@section('content_header')
    <h1>Histórico</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Histórico</h3>
        </div>
        <div class="box-body">
            @include('admin.elements.alerts')
            <form action="{{ route('admin.historic.search') }}" method="get" class="form form-inline">
                <input type="text" name="id" class="form-control" placeholder="ID">
                <input type="date" name="date" class="form-control" placeholder="Data">
                <select name="type" id="" class="form-control">
                    <option value="">Todos</option>
                    @foreach ($types as $key => $type)
                        <option value="{{ $key }}">
                            {{ $type }}
                        </option>
                    @endforeach
                </select>
                <button class="btn btn-primary">Buscar</button>
            </form>
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Valor</th>
                        <th>Tipo</th>
                        <th>Data</th>
                        <th>Recebedor</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($historics as $historic)
                    <tr>
                        <td>{{ $historic->id }}</td>
                        <td>{{ $historic->amount_readable }}</td>
                        <td>{{ $historic->type($historic->type) }}</td>
                        <td>{{ $historic->date }}</td>
                        <td>
                            @if ($historic->user_id_transaction)
                                {{ $historic->userSender->name }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="100%">
                            Nenhum histórico registrado
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            @if (isset($dataForm))
                {!! $historics->appends($dataForm)->links() !!}
            @else
                {!! $historics->links() !!}
            @endif
        </div>
    </div>
@stop