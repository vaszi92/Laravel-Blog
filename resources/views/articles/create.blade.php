@extends('app')

@section('content')
    <h1>Write a new article</h1>
    <a href="{{ url('articles') }}">Back to Articles</a>
    <hr>
    
    {!! Form::model($article = new \App\Article, ['url'=>'articles']) !!}
    
       @include('articles.form', ['submitButtonText'=>'Add Article'])
    
    {!! Form::close()!!}

    @include('errors.list')
    
@stop