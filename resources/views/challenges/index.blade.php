@extends('layouts.app')

@section('content')

@if(count($challenges) > 0)
    @if(!Auth::guest())
        @if(Auth()->User()->isAdmin() == 2)
            <div style="float: right"><h3>Admin: {{Auth()->User()->name}}</h3></div>
            <div class="card-body" style="padding-botton: 1em;">
                <a class="btn btn-primary" href="challenges/create">Create new challenge</a>
            </div>
         @endif
    @endif
    
    <hr>
    
    @foreach($challenges as $challenge)
                
                <div class="well" style="padding-top: 1em;">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <img style="width: 75%" src="/storage/challenge_images/{{$challenge->challenge_image}}">
                            
                        </div>
                        <div>
                            <h3>{{$challenge->title}}</h3>     
                            @if(!Auth::guest())                       {{-- {!! $challenge->body !!} --}}
                                @if(Auth()->User()->level >= $challenge->level || Auth()->User()->isAdmin() == 2)
                                    <a class="btn btn-primary" href="/challenges/{{$challenge->id}}">Enroll</a>
                                @else
                                    
                                    <div class="alert alert-info" style="float:left">
                                    You must reach level <strong>{{$challenge->level}}</strong> to unlock this challenge! 
                                    </div>
                                    
                                @endif
                            @endif
                        </div>
                    
                    </div> 
                </div>
            @endforeach
            {{$challenges->links()}}
@else
    <h1>No challenges posted yet</h1>   
    @if(Auth()->User()->isAdmin())
        <a href="challenges/create" class="btn btn-primary">Create new challenge</a>
    @endif
@endif
    
@endsection