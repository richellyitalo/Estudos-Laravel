@extends('adminlte::page')

@section('title', 'Saldo')

@section('content_header')
    <h1>Depósito</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Depositar</h3>
        </div>
        <div class="box-body">
            <form action="{{ route('admin.depositStore') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" name="amount" class="form-control" placeholder="Valor da recarga">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Recarregar</button>
                </div>
            </form>
        </div>
    </div>
@stop