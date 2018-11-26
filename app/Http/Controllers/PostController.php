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
        $posts = Post::simplePaginate(6);
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
        //dd($post->id);
        return redirect('post/'.$post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, $id)
    {
       

        $post = Post::where('id', $id)->get();
    
        $comments = Comment::where('post_id', $id)->get();

        $likes = Like::where('post_id', $id)->get();

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
    public function edit(Post $post, $id)
    {
        $edit_post = Post::where('id', $id)->first();

        return view('pages.edit')->with('edit_post', $edit_post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post, $id)
    {
        $post = Post::find($id);

        $post->title = $request->title;

        $post->body = $request->body;

        $post->save();

        return redirect('/post/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, $id)
    {
        $post_delete = Post::find($id);

        $post_delete->delete();

        return redirect('/posts');
        
    }

    public function image_up(Request $request, $id) {
       $path = $request->file('image')->store('/public');
       $path = str_replace("public/", "storage/", $path);
        
       // echo $path;
        // dd($path);

       $image_path = Post::find($id);

       $image_path->image_path = $path;

       $image_path->save();


       return redirect('/post/'.$id);
    }

    public function delete_image($id) {
        $image = Post::find($id);

        $image->image_path = null;

        $image->save();

        return redirect('/post/'.$id);
    }

    
}
