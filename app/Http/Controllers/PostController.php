<?php

namespace App\Http\Controllers;

use App\Like;
use Validator;
use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class PostController extends Controller
{
    protected $dates = ['created_at'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('CREATED_AT', 'desc')->groupBy('title')->simplePaginate(6);
        $user = User::all();

       

        return view('pages.posts')->with('posts', $posts)->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:30',
            'body' => 'required|max:300',
            'image' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();
                        
        }
        
       $path = $request->file('image')->store('/public');
       $path = str_replace('public/', 'storage/', $path);
        
       
        $post = new Post;

        $post->title = $request->title;

        $post->body = $request->body;

        $post->image_path = $path;

        $post->author_name = Auth::user()->name;

        $post->author_id = Auth::user()->id;

        $post->save();
        
        return redirect('post/'.$post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
       
        $comments = Comment::where('post_id', $post->id)->get();

        $likes = Like::where('post_id', $post->id)->get();



        foreach ($likes as $like) {
            if ($like->user_id == Auth::user()->id) {
            $likes = true;
            } else {
                $likes = false;
            }
        } 

        return view('pages.post')->with('post', $post)->with('comments', $comments)->with('likes', $likes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $edit_post = $post;

        return view('pages.edit')->with('edit_post', $edit_post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post, Request $request)
    {

        $post->title = $request->title;

        $post->body = $request->body;

        $post->save();

        return redirect('/post/'.$post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect('/posts');
        
    }

    public function image_up(Post $post, Request $request) {
        if ($request->file('image') == null) {
            return redirect(url()->previous());
        }

       $path = $request->file('image')->store('/public');
       $path = str_replace("public/", "storage/", $path);


       $post->image_path = $path;

       $post->save();


       return redirect('/post/'.$post->id);
    }

    public function delete_image(Post $post) {

        $post->image_path = null;

        $post->save();

        return redirect('/post/'.$post->id);
    }

    
}
