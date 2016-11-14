@extends('app')

@section('content')
<div class="content">
        <div class="title">Contact page for {{$first}} {{$last}}</div>
        <div class="quote">{{ Inspiring::quote() }}</div>
</div>
@stop

@section('footer')
<script>alert('Hello from the contact page!')</script>
@stop