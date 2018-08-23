@extends('adminlte::page')

@section('title', 'Saldo')

@section('content_header')
    <h1>Saldo</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <a href="{{ route('admin.deposit') }}" class="btn btn-primary">
                <i class="fa fa-cart-plus"></i>
                Recarregar
            </a>
            @if ($amount > 0)
                <a href="{{ route('admin.withdraw') }}" class="btn btn-danger">
                    <i class="fa fa-cart-plus"></i>
                    Sacar
                </a>
                <a href="{{ route('admin.transfer') }}" class="btn btn-info">
                    <i class="fa fa-exchange"></i>
                    Transferir
                </a>
            @endif
        </div>
        <div class="box-body">
            @include('admin.elements.alerts')
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><sup style="font-size: 20px">R$</sup> {{ $amount }}</h3>

                    <p>Saldo</p>
                </div>
                <div class="icon">
                    <i class="ion ion-cash"></i>
                </div>
                    <a href="{{ route('admin.historic') }}" class="small-box-footer">Histórico <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
@stop