@extends('adminlte::page')

@section('title', 'Confirmar transferência')

@section('content_header')
    <h1>Confirmar transferência</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Confirmar transferência</h3>
        </div>
        <div class="box-body">
            @include('admin.elements.alerts')
            <p>Recebedor: <strong>{{ $sender->email }}</strong></p>
            <p>Seu saldo atual: <strong>R$ {{ $balance }}</strong></p>
            <form action="{{ route('admin.transfer.store') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="sender_id" value={{ $sender->id }}>
                <div class="form-group">
                    <input type="text" name="amount" class="form-control" placeholder="Valor da recarga">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Transferir</button>
                </div>
            </form>
        </div>
    </div>
@stop