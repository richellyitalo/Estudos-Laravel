@extends('adminlte::page')

@section('title', 'Transferir')

@section('content_header')
    <h1>Transferir</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Transferir</h3>
        </div>
        <div class="box-body">
            @include('admin.elements.alerts')
            <form action="{{ route('admin.confirm.transfer') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="Informe e-mail do recebedor">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Avançar</button>
                </div>
            </form>
        </div>
    </div>
@stop