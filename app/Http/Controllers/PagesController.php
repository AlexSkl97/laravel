<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to AR-online-shop!';
        return view('pages.index')->with('title', $title);
    }

    public function about(){
        $title = 'About us';
        return view('pages.about')->with('title', $title);
    }

    public function services(){
        $title = '';
        return view('pages.services')->with('title', $title);
    }

    public function profile(){
        $users = User::All();
        return view('pages.profile')->with('users', $users);
    }
}
