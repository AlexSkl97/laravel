<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        //$posts = Post::All();
        $posts = Post::orderBy('created_at','desc')->paginate(3);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
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
            'cover_image' => 'image|nullable|max:1999',
            'cover_image2' => 'image|nullable|max:1999',
            'cover_image3' => 'image|nullable|max:1999',
            'cover_image4' => 'image|nullable|max:1999',

        ]);
        
        //Handle file upload
        if($request->hasFile('cover_image')){
            //Get filename with the extension 
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just the extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            //Upload the image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $filenameToStore);
        }
        else{
            $filenameToStore = 'noimage.jpg';
        }

        if($request->hasFile('cover_image2')){
            //Get filename with the extension 
            $filenameWithExt2 = $request->file('cover_image2')->getClientOriginalName();
            //Get just filename
            $filename2 = pathinfo($filenameWithExt2, PATHINFO_FILENAME);
            //Get just the extension
            $extension2 = $request->file('cover_image2')->getClientOriginalExtension();
            //Filename to store
            $filenameToStore2 = $filename2.'_'.time().'.'.$extension2;
            //Upload the image
            $path2 = $request->file('cover_image2')->storeAs('public/cover_images', $filenameToStore2);
        }
        else{
            $filenameToStore2 = 'noimage.jpg';
        }

        if($request->hasFile('cover_image3')){
            //Get filename with the extension 
            $filenameWithExt3 = $request->file('cover_image3')->getClientOriginalName();
            //Get just filename
            $filename3 = pathinfo($filenameWithExt3, PATHINFO_FILENAME);
            //Get just the extension
            $extension3 = $request->file('cover_image3')->getClientOriginalExtension();
            //Filename to store
            $filenameToStore3 = $filename3.'_'.time().'.'.$extension3;
            //Upload the image
            $path3 = $request->file('cover_image3')->storeAs('public/cover_images', $filenameToStore3);
        }
        else{
            $filenameToStore3 = 'noimage.jpg';
        }

        if($request->hasFile('cover_image4')){
            //Get filename with the extension 
            $filenameWithExt4 = $request->file('cover_image4')->getClientOriginalName();
            //Get just filename
            $filename4 = pathinfo($filenameWithExt4, PATHINFO_FILENAME);
            //Get just the extension
            $extension4 = $request->file('cover_image4')->getClientOriginalExtension();
            //Filename to store
            $filenameToStore4 = $filename4.'_'.time().'.'.$extension4;
            //Upload the image
            $path4 = $request->file('cover_image4')->storeAs('public/cover_images', $filenameToStore4);
        }
        else{
            $filenameToStore4 = 'noimage.jpg';
        }

        //Create new post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $filenameToStore;
        $post->cover_image2 = $filenameToStore2;
        $post->cover_image3 = $filenameToStore3;
        $post->cover_image4 = $filenameToStore4;
        $post->save();

        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        // Check for correct user
        if(auth()->user()->id != $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        return view('posts.edit')->with('post',$post);
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

        //Handle file upload
        if($request->hasFile('cover_image')){
            //Get filename with the extension 
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just the extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            //Upload the image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $filenameToStore);
        }
       

        
        // Update post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $filenameToStore;
        }
        $post->save();

        return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $post = Post::find($id);

        // Check for the correct user

        if(auth()->user()->id != $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized page');
        }

        if($post->cover_image != 'noimage.jpg'){
            //Delete image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success', 'Post deleted');
    }

    public function search(Request $request){

        $query = $request->input('query');
        
        $posts = Post::where('title', 'like', "%$query%")->get();
        return view('posts.search')->with('posts', $posts);
    }

    public function userProfile(Request $request){

        $user_id = $request->input('user_id');
        $user = User::find($user_id);

        return view('posts.userProfile')->with('user', $user);

    }

    public function addLikes($id){

        $post = Post::find($id);
        $post->likes += $post->likes;

    }
}
