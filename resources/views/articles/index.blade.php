@extends('app')

@section('content')

    <h1>Articles</h1>
    <a href="{{url('articles/create')}}">Create Article</a>
    <br />
    <a href="{{url('auth/logout')}}">Log Out</a>
    <hr>
    @foreach($articles as $article)
    <article>
        <h2><a href="{{ url('/articles', $article->id) }}">{{ $article->title }}</a></h2>
        <div class="body">{{ $article->body }}</div>
    </article>
    @endforeach

@stop

