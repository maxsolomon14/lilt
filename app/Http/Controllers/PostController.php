<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Validator;

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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:30',
            'body'  => 'required|max:300',
            'image' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->file('image_path') !== null) {
            $path = $request->file('image')->store('/public');
            $path = str_replace('public/', 'storage/', $path);
        } else {
            $path = null;
        }
        $post = Post::create(['title'           => $request->title,
                                  'body'        => $request->body,
                                  'image_path'  => $path,
                                  'author_name' => Auth::user()->name,
                                  'author_id'   => Auth::user()->id, ]);

        return redirect('post/'.$post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Post $post
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $comments = Comment::where('post_id', $post->id)->get();

        $likes = Like::where('post_id', $post->id)->first();

        $hasLiked = Auth::user()->likes()->where('post_id', '=', $post->id)->exists();

        $logUnliked = trans_choice('likes.likes_not_liked', $post->likes->count(), ['likes_test' => ($post->likes->count() - 1), 'likes' => $post->likes->count(), 'name' => $post->author_name."'s"]);
        $userspost = trans_choice('likes.user_post', $post->likes->count(), ['likes' => $post->likes->count()]);
        $logLiked = trans_choice('likes.likes_liked', $post->likes->count(), ['likes_test' => ($post->likes->count() - 1), 'likes' => $post->likes->count(), 'name' => $post->author_name."'s"]);

        if ($likes !== null or $hasLiked) {
            $hasLiked = true;
        } else {
            $hasLiked = false;
        }

        if ($hasLiked) {
            $logic = '<p>'.$logLiked.'</p> <a class="btn btn-secondary" role="button" href="/unlike/'.Auth::user()->id.'/'.$post->id.'">Unlike</a>';
        } else {
            $logic = '<p>'.$logUnliked.'</p> <a href="/like/'.$post->id.'/'.Auth::user()->id.'" class="btn btn-primary" role="button">Like</a>';
        }

        return view('pages.post')->withPost($post)->withlogic($logic)->withuserspost($userspost);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Post $post
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $editpost = $post;

        if ($post->author_id !== Auth::user()->id) {
            abort(404);
        }

        return view('pages.edit')->withEditpost($editpost);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Post                $post
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post, Request $request)
    {
        $post->update(['title' => $request->title,
                       'body'  => $request->body, ]);

        return redirect("/post/$post->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect('/posts');
    }

    public function image_up(Post $post, Request $request)
    {
        if ($request->file('image') == null) {
            return redirect(url()->previous());
        }

        $path = $request->file('image')->store('/public');
        $path = str_replace('public/', 'storage/', $path);

        $post->image_path = $path;

        $post->save();

        return redirect('/post/'.$post->id);
    }

    public function delete_image(Post $post)
    {
        $post->image_path = null;

        $post->save();

        return redirect('/post/'.$post->id);
    }
}
