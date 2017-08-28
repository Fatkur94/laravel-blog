<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//calling Post for ORM
use App\Post;
//calling DB for raw sql
use DB;

class PostsController extends Controller
{   
    /**
     * Create a new controller instance.
     * overriding guest to access User
     * @return void
     */
     public function __construct()
     {
         $this->middleware('auth', ['except'=>['index', 'show']]);
     }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //use Built in ORM with all query
        //$posts = Post::all();

        //use orderBy orm
        //$posts = Post::orderBy('created_at', 'desc')->get();

        //use orderBy with pagination
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        //use raw sql query
        //$posts = DB::select('select * from posts');
        $data = array(
            'posts'=>$posts
        );
        return view('posts.index')->with($data);
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
            'body' => 'required'
        ]);
        
        // create post
        $posts = new Post;
        $posts->title = $request->input('title');
        $posts->body = $request->input('body');
        $posts->user_id = auth()->user()->id;
        $posts->save();
            
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
        $data = array(
            'post'=>$post
        );
        return view('posts.show')->with($data);
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

        //check the correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'unautherized page');
        }
        $data = array(
            'post'=>$post
        );
        return view('posts.edit')->with($data);
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
        // update post
        $posts = Post::find($id);
        $posts->title = $request->input('title');
        $posts->body = $request->input('body');
        $posts->save();
            
        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete post\
        $posts = Post::find($id);
        
        //check the correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'unautherized page');
        }

        $posts->delete();
        return redirect('/posts')->with('success', 'Post deleted');
    }
}
