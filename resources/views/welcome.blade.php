@extends('app')

@section('content')
<div class="content text-center" style="margin-top:100px;">
        <h1>Welcome, {{ $user['name'] }}!</h1>
        @if(Auth::user())
        <a href="{{url('auth/logout')}}">Log Out</a>
        @else
        <a href="{{url('auth/login')}}">Please log in in order to access the full site.</a>
        @endif
        <div class="quote">{{ Inspiring::quote() }}</div>
</div>
@endsection