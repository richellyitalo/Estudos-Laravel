@extends('layouts.site')

@section('title', 'Perfil')

@section('content')
    <h1>Meu Perfil</h1>
    <a href="{{ route('admin.home') }}">Voltar ao admin</a>
    @include ('admin.elements.alerts')
    <form 
        action="{{ route('admin.profile.update') }}" 
        method="post" 
        class="form" 
        enctype="multipart/form-data"
    >
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
            <input type="text" name="email" class="form-control" value="{{ auth()->user()->email }}">
        </div>
        <div class="form-group">
            <label for="">
                Senha
            </label>
            <input type="password" name="new_password" class="form-control">
        </div>
        @if (auth()->user()->image != null)
            <img src="{{ url('storage/users/' . auth()->user()->image) }}" alt=""
                style="max-width: 150px;"
            >
        @else
            <div class="alert alert-warning">Perfil sem imagem</div>
        @endif
        <div class="form-group">
            <label for="">
                Imagem
            </label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group">
            <button class="btn btn-success">Atualizar meus dados</button>
        </div>
    </form>
@stop