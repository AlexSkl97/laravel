<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Challenge;
use Illuminate\Support\Facades\Storage;

class ChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $challenges = Challenge::orderBy('level','asc')->paginate(3);
        return view('challenges.index')->with('challenges', $challenges);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('challenges.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'key' => 'required',
            'level' => 'required',
            'challenge_image' => 'image|nullable|max:1999'
        ]);

        // Handle file upload

        if($request->hasFile('challenge_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('challenge_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('challenge_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload image
            $path = $request->file('challenge_image')->storeAs('public/challenge_images', $fileNameToStore);
        }
        else{
            $fileNameToStore = 'noimage.jpg';
        }

        // Create challenge

        $challenge = new Challenge;
        $challenge->title = $request->input('title');
        $challenge->body = $request->input('body');
        $challenge->key = $request->input('key');
        $challenge->level = $request->input('level');
        $challenge->challenge_image = $fileNameToStore;
        $challenge->save();

        return redirect('/challenges')->with('success', 'Challenge Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $challenge = Challenge::find($id);
        return view('challenges.show')->with('challenge', $challenge);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $challenge = Challenge::find($id);

        // Check for correct user
        if(auth()->user()->isAdmin() !=2){
            return redirect('/challenges')->with('error', 'Unauthorized Page');
        }

        return view('challenges.edit')->with('challenge',$challenge);
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
            'title' => 'required',
            'body' => 'required'
        ]);

        if($request->hasFile('challenge_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('challenge_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('challenge_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload image
            $path = $request->file('challenge_image')->storeAs('public/challenge_images', $fileNameToStore);
        }
        else{
            $fileNameToStore = 'noimage.jpg';
        }

        $challenge = Challenge::find($id);
        $challenge->title = $request->input('title');
        $challenge->body = $request->input('body');
        $challenge->key = $request->input('key');
        $challenge->level = $request->input('level');
        if($request->hasFile('challenge_image')){
            $challenge->challenge_image = $fileNameToStore;
        }

        $challenge->save();

        return redirect('/challenges')->with('success', 'Challenge Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $challenge = Challenge::find($id);

        // Check for the correct user

        if(auth()->user()->isAdmin() != 2){
            return redirect('/challenges')->with('error', 'Unauthorized page');
        }

        if($challenge->challenge_image != 'noimage.jpg'){
            //Delete image
            Storage::delete('public/challenge_images/'.$challenge->challenge_image);
        }

        $challenge->delete();
        return redirect('/challenges')->with('success', 'Challenge deleted');
    }
}
