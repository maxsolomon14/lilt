<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Like;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($post_id, $user_id)
    {

        $post = Post::find($post_id);

        $find = Like::where(['post_id' => $post_id, 'user_id' => $user_id])->first();
        // dd($find);
        
        
        if ($find != null or $post->user->id == $user_id) {
            return redirect(url()->previous());
        } else {
            return redirect('/like-save/'.$post_id.'/'.$user_id);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($post_id, $user_id)
    {
       
       
        $like = new Like;

        $like->post_id = $post_id;

        $like->user_id = $user_id;

        $like->save();

        return redirect('/post/'.$post_id);
    
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
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like, $id, $post_id)
    {
        $like_delete = Post::where('user_id', '=', $id);

        DB::delete('DELETE FROM likes WHERE user_id = ? and post_id = ?', [$id, $post_id]);


        return redirect('/post/'.$post_id);
        
    }
}
