@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    {!! Form::open(['action' => 'PostController@store' , 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
                {{Form::label('title', 'Body')}}
                {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body text'])}}
        </div>
        <div class="form-group">
                {{Form::file('cover_image')}}
        </div>
        <div class="form-group">
                {{Form::file('cover_image2')}}
        </div>
        <div class="form-group">
                {{Form::file('cover_image3')}}
        </div>
        <div class="form-group">
                {{Form::file('cover_image4')}}
        </div>
    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
    
@endsection