@extends('app')

@section('content')
    <a href="{{url('articles')}}">Back to the Articles</a>
    <h1>{{ $article->title }}</h1>
    <hr>
    <article>
        {{ $article->body }}
    </article>
    <hr>
    <h5>Tags:</h5>
    @unless($article->tags->isEmpty())
        <ul>
            @foreach($article->tags as $tag)
                <li>{{ $tag->name }}</li>
            @endforeach
        </ul>
    @endunless
    <hr>
    {!! link_to_action('ArticlesController@edit', 'Edit Article', $article->id, ['class'=>'btn btn-warning']); !!}
    
<!--    {!! link_to_action('ArticlesController@destroy', 'Delete Article', $article->id, ['method'=>'DELETE', 'class'=>'btn btn-danger', 'onClick'=>'return confirm("Are you sure you want to delete this item?")']); !!}-->
    <br />
    {!! Form::model($article, ['method'=>'DELETE', 'action'=>['ArticlesController@destroy', $article->id]]) !!}
    
        <div class="form-delete">
            {!! Form::submit('Delete Article', ['class'=>'btn btn-danger',  'onClick'=>'return confirm("Are you sure you want to delete this item?")']) !!}
        </div> 
    
    {!! Form::close()!!}

@stop

