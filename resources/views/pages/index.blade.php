@extends('layouts.app')

@section('content')
    @if(Auth::guest())
    <div class="jumbotron text-center">
        <h1>Welcome to AR-online-shop!</h1>
        <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> <a class="btn btn-success btn-lg" href="/register" role="button">Register</a>
    </div>
    @else
    <div class="jumbotron text-center">
        <h1>Welcome to AR-online-shop!</h1>
        <p><a class="btn btn-primary" href="{{ route('logout') }}"
            onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
      Logout
      </a>
    </div>
    {{-- <div class="jumbotron text-center"><a class="btn btn-primary" href="{{ route('logout') }}"
           onclick="event.preventDefault();
         document.getElementById('logout-form').submit();">
     Logout
     </a></div> --}}
    
    @endif

@endsection