@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>    

    @foreach($users as $user)
    
    <div class="well">
            <div style="border-top:5px;border-bottom:5px;"><img src="/storage/profile_images/{{$user->profile_image}}" alt="{{$user->name }}" style="width:160px;height:160px;border-radius:50%"></div>
            <hr>
            <div style="margin-bottom:1.5em"><small class="text-muted" style="font-size:20px">Contact details</small></div>
            
            <div style="border-bottom:2em">
                <h4><i class="glyphicon glyphicon-user"></i> Username: {{$user->name }}</h4>     
                <h4><i class="glyphicon glyphicon-envelope"></i> Email: {{$user->email}}</h4>
                <h4>&nbsp<i class="fa fa-mobile-phone" style="font-size:18px"></i></i> &nbspPhone number: {{$user->mobileNumber}}</h4>
            </div>
    </div>
    @endforeach

@endsection