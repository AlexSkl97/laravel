@extends('layouts.app')

@section('content')

    <h1>Create challenge</h1>
    {!! Form::open(['action' => 'ChallengeController@store' , 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('title', 'Body')}}
            {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body text'])}}
        </div>
        <div>
            {{Form::label('key', 'Key')}}
            {{Form::text('key', '', ['class' => 'form-control', 'placeholder' => 'Enter the key for this challenge'])}}
        </div>
        <br>
        <div>
            {{Form::label('level', 'Level')}}
            {{Form::text('level', '', ['class' => 'form-control', 'placeholder' => 'Enter the level required for this challenge'])}}
        </div>
        <br>
        <div class="form-group">
            {{Form::file('challenge_image')}}
        </div>
        
    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}

@endsection