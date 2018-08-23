@extends('adminlte::page')

@section('title', 'Saque')

@section('content_header')
    <h1>Saque</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Sacar</h3>
        </div>
        <div class="box-body">
            @include('admin.elements.alerts')
            <form action="{{ route('admin.withdraw.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" name="amount" class="form-control" placeholder="Valor da recarga">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Sacar</button>
                </div>
            </form>
        </div>
    </div>
@stop