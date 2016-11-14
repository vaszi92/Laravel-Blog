@extends('app')

@section('content')
<div class="content">
        <div class="title">ABOUT: 
            @if($first == 'Roger')
            {{$first}} {{$last}}
            @else 
            {{$last}} {{$first}}
            @endif
        </div>
        <div class="quote">{{ Inspiring::quote() }}</div>
</div>
@stop