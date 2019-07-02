@extends('layouts.app')

@section('content')

    <h1>Edit challenge</h1>
    {!! Form::open(['action' => ['ChallengeController@update', $challenge->id] , 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $challenge->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', $challenge->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body text'])}}
        </div>
        <div>
            {{Form::label('key', 'Key')}}
            {{Form::text('key', $challenge->key, ['class' => 'form-control', 'placeholder' => 'Enter the key for this challenge'])}}
        </div>
        <br>
        <div>
            {{Form::label('level', 'Level')}}
            {{Form::text('level', $challenge->level, ['class' => 'form-control', 'placeholder' => 'Enter the level required for this challenge'])}}
        </div>
        <br>
        <div class="form-group">
            {{Form::file('challenge_image')}}
        </div>
        
    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}

@endsection