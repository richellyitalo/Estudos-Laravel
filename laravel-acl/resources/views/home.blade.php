@extends('layouts.app')

@section('content')
<div class="container">
    @forelse ($posts as $post)
        <h2>{{$post->title}}</h2>
        <p>{{$post->description}}</p>
        <p>Publicado por <strong>{{$post->user->name}}</strong></p>
        @can ('editarPost', $post)
            <p><a href="post/editar/{{$post->id}}">Editar</a></p>
        @endcan
    @empty
        <h3>Nenhum post encontrando</h3>
    @endforelse
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
