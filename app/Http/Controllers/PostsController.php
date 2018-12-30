<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use DB;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Blokira pot ce nisi prijavljen
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $posts = Post::all();
//        $posts = Post::orderBy('title', 'desc')->get();
//        return Post::where('title', 'Post Two')->get();
//        $posts = DB::select('select * from posts');

//        $posts = Post::all();
        //pagination
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
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
        //validacija
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle file upload
        if($request->hasFile('cover_image')){
            //Get filename with the extension
            $filenamewithExt = $request->file('cover_image')->getClientOriginalName();

            //Get just filename
            $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);

            //Get just ext
            $extension = $request->file('cover_image')->guessClientExtension();

            //FileName to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //Upload Image   !!! mores naret php artisan storage:link da imas dostop do storage v public
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }
        else {
            $fileNameToStore = 'no-image.png';
        }

        //Create Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();
        return redirect('/posts') -> with('success', 'Post Created');
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
        return view('posts.show')->with('post', $post);
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

        //preveri za pravilnega uporabnika
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        return view('posts.edit')->with('post', $post);
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
        //validacija
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        // Handle file upload
        if($request->hasFile('cover_image')){
            //Get filename with the extension
            $filenamewithExt = $request->file('cover_image')->getClientOriginalName();

            //Get just filename
            $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);

            //Get just ext
            $extension = $request->file('cover_image')->guessClientExtension();

            //FileName to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //Upload Image   !!! mores naret php artisan storage:link da imas dostop do storage v public
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }

        //Update User
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        $post->save();
        return redirect('/posts') -> with('success', 'Post Updated');
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

        //preveri za pravilnega uporabnika
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        if($post->cover_image != 'no-image.png'){
            //Delete Image
            Storage::delete('public/cover_images'.$post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success', 'Post Removed');
    }
}
