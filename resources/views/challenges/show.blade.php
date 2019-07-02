@extends('layouts.app')

@section('content')

    <a href="/challenges" class="btn btn-default">Go back</a>
    @if(Auth()->User()->isAdmin() == 2)
        
            <a class="btn btn-default" href = "/challenges/{{$challenge->id}}/edit">Edit</a>
            <div style="padding-top: 1em">
            {!!Form::open(['action' => ['ChallengeController@destroy', $challenge->id], 'method' => 'POST'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close() !!}
            </div>
    @endif
    <hr>
    
    <img style="width: 160px; height: 160px;" src="/storage/challenge_images/{{$challenge->challenge_image}}">
    <h3>Challenge title: {{$challenge->title}}</h3>
    <hr>
    
    <div>
        <h3>Description:</h3>
        {!! $challenge->body !!}
        
    </div>
    <hr>
    <small>created at {{$challenge->created_at}}</small>
    <hr>
@endsection