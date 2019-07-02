@extends('layouts.app')

@section('content')
    
    {!! Form::open(['action' => ['UserController@update', $user->id] , 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Name')}}
            {{Form::text('Name', $user->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('title', 'E-mail')}}
            {{Form::text('E-mail', $user->email, ['class' => 'form-control', 'placeholder' => 'E-mail'])}}
        </div>
        <div class="form-group">
                {{Form::file('profile_image')}}
        </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
    
@endsection