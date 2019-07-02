@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>    

    <a href="/posts" class="btn btn-default">Go back</a>
    <hr>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        .mySlides {display:none;}
    </style>
    <body>

    <div class="w3-content w3-display-container">
    <img class="mySlides" src="/storage/cover_images/{{$post->cover_image}}" style="width:100%">
    <img class="mySlides" src="/storage/cover_images/{{$post->cover_image2}}" style="width:100%">
    <img class="mySlides" src="/storage/cover_images/{{$post->cover_image3}}" style="width:100%">
    <img class="mySlides" src="/storage/cover_images/{{$post->cover_image4}}" style="width:100%">

    <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
    <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
    </div>

    <script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
    showDivs(slideIndex += n);
    }

    function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("mySlides");
        if (n > x.length) {slideIndex = 1}
        if (n < 1) {slideIndex = x.length}
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
        }
        x[slideIndex-1].style.display = "block";  
    }
    </script>
    {!!Form::open(['action' => ['PostController@addLikes', $post->id], 'method' => 'POST'])!!}
    {{-- {{Form::hidden('_method', 'DELETE')}} --}}
    {{Form::submit('Like', ['class' => 'glyphicon glyphicon-thumbs-up'])}}
    {!!Form::close() !!}

    <h3>Post title: {{$post->title}}</h3>
    <hr>
    
    <div>
        <h3>Description:</h3>
        {!! $post->body !!}
    
    </div>
    

    <hr>
    <h3>Contact details: </h3>
    
    <div>
        <small><i class="glyphicon glyphicon-user"></i> Username: {{$post->user->name }}&nbsp</small>     
        <small><i class="glyphicon glyphicon-envelope"></i>&nbspEmail: {{$post->user->email}}</small>
        <small>&nbsp<i class="fa fa-mobile-phone" style="font-size:18px"></i></i> &nbspPhone number: {{$post->user->mobileNumber}}</small>
    </div>

    <hr>
    <small>created at {{$post->created_at}} by {{$post->user->name}}</small>
    
    <br><br>
    
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>

            {!!Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close() !!}

        @endif
    @endif
    <br><br>
@endsection