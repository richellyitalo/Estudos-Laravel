@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{$post->title}}</h2>
    <p>{{$post->description}}</p>
    <p>Publicado por <strong>{{$post->user->name}}</strong></p>
</div>
@endsection
