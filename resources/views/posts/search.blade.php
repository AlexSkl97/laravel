@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <form action="{{route('search')}}" method="GET" class="search-form">
        
    <input type="text" name="query" id="query" value="{{ request()->input('query') }}" class="search-box" placeholder="Search for product">
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>

    <h1>Search results</h1>
    <br>

    <div class="search-container container">
        <p>result(s) for '{{ request()->input('query') }}'</p>
        @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width: 100%" src="/storage/cover_images/{{$post->cover_image}}">
                        
                    </div>
                    <div class="col-md-4 col-sm-4">
                            
                            <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                            <small>Created at {{$post->created_at}} by {{$post->user->name}}</small>
                    </div>
                </div> 
            </div>
        @endforeach
        @else
        <h3>No posts</h3>
        @endif
    </div>
   
    {{-- @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width: 100%" src="/storage/cover_images/{{$post->cover_image}}">
                        
                    </div>
                    <div class="col-md-4 col-sm-4">
                            
                            <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                            <small>Created at {{$post->created_at}} by {{$post->user->name}}</small>
                    </div>
                </div> 
            </div>
        @endforeach
        {{$posts->links()}}

    @else
        <h3>No posts</h3>
    @endif --}}
    
@endsection