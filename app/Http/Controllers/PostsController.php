<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Post\CreatePostRequest;
use App\Post;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index')->with('posts',$posts);
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
    public function store(CreatePostRequest $request)
    {
        //upload image to the storage
        $image = $request->image->store('posts');
        //create the post

        Post::create([
            'title' => $request->title,
            'content' =>$request->content,
            'description' =>$request->description,
            'image' =>$image,
            'published_at'=>$request->published_at
        ]);
        //flash the message
        session()->flash('success','Post created successfully');
        //redirect user

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id',$id)->firstOrFail();

        //permanently delete
        if($post->trashed())
        {
            Storage::delete($post->image);
            $post->forceDelete();
        }
        else{
            $post->delete();
        }
        session()->flash('success','Post deleted successfully');
        return redirect(route('posts.index'));

    }

    /**
     * display all the trashed posts.
     *
     *
     * @return \Illuminate\Http\Response
     */

    public function trashed(){
        $trashed = Post::onlyTrashed()->get();

        return view('posts.index')->withPosts($trashed);
    }
}
