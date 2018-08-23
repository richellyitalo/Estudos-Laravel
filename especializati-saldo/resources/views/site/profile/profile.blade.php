@extends('layouts.site')

@section('title', 'Perfil')

@section('content')
    <h1>Meu Perfil</h1>
    <a href="{{ route('admin.home') }}">Voltar ao admin</a>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form action="{{ route('admin.profile.update') }}" method="post" class="form">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="">
                Nome
            </label>
            <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}">
        </div>
        <div class="form-group">
            <label for="">
                E-mail
            </label>
            <input type="text" email="email" class="form-control" value="{{ auth()->user()->email }}">
        </div>
        <div class="form-group">
            <label for="">
                Senha
            </label>
            <input type="password" name="new_password" class="form-control">
        </div>
        <div class="form-group">
            <label for="">
                Imagem
            </label>
            <input type="file" name="file" class="form-control">
        </div>
        <div class="form-group">
            <button class="btn btn-success">Atualizar meus dados</button>
        </div>
    </form>
@stop