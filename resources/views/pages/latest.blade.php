@extends('app')

@section('content')
    <a href="{{url('articles')}}">Back to the Articles</a>
    <h1>{{ $latest->title }}</h1>
    <hr>
    <article>
        {{ $latest->body }}
    </article>
    <hr>
    <h5>Tags:</h5>
    @unless($latest->tags->isEmpty())
        <ul>
            @foreach($latest->tags as $tag)
                <li>{{ $tag->name }}</li>
            @endforeach
        </ul>
    @endunless
    <hr>
    {!! link_to_action('ArticlesController@edit', 'Edit Article', $latest->id, ['class'=>'btn btn-warning']); !!}
    
    <br />
    {!! Form::model($latest, ['method'=>'DELETE', 'action'=>['ArticlesController@destroy', $latest->id]]) !!}
    
        <div class="form-delete">
            {!! Form::submit('Delete Article', ['class'=>'btn btn-danger',  'onClick'=>'return confirm("Are you sure you want to delete this item?")']) !!}
        </div> 
    
    {!! Form::close()!!}

@stop

