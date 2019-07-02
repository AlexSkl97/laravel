@extends('layouts.app')

@section('content')
    {!! Form::open(['action' => ['UserController@update', Auth::user()->id] , 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title', 'Name')}}
        {{Form::text('Name', Auth::user()->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
    </div>
    <div class="form-group">
        {{Form::label('title', 'E-mail')}}
        {{Form::text('E-mail', Auth::user()->email, ['class' => 'form-control', 'placeholder' => 'E-mail'])}}
    </div>
    <div>
            {{Form::label('title', 'Mobile Number')}}
            {{Form::text('Mobile_Number', Auth::user()->mobileNumber, ['class' => 'form-control', 'placeholder' => 'Mobile Number'])}}
        </div>
    <br>
    <div class="form-group">
        {{Form::file('profile_image')}}
    </div>
    
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
   
    
@endsection