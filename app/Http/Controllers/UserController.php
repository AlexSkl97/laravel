<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show')->with('users', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'Name' => 'required',
            'E-mail' => 'required',
            'profile_image' => 'image|nullable|max:1999'
        ]);

        //Handle file upload
        if($request->hasFile('profile_image')){
            //Get filename with the extension 
            $filenameWithExt = $request->file('profile_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just the extension
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            //Filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            //Upload the image
            $path = $request->file('profile_image')->storeAs('public/profile_images', $filenameToStore);
        }
       

        
        // Update user
        $user = User::find($id);
        $user->name = $request->input('Name');
        $user->email = $request->input('E-mail');
        $user->mobileNumber = $request->input('Mobile_Number');
        if($request->hasFile('profile_image')){
            $user->profile_image = $filenameToStore;
        }
        else{
            $filenameToStore = 'noimage.jpg';
        }
        $user->save();

        return redirect('/users')->with('success', 'Profile Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    
}
