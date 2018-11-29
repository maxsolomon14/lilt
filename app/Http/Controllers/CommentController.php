<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class CommentController extends Controller
{
    public function AddComment(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required|max:200',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();
        }

        $user_id = Auth::user()->id;

        $comm = Comment::create(['user_name' => Auth::user()->name,
                                 'user_id'   => $user_id,
                                 'comment'   => $request->comment,
                                 'post_id'   => $id, ]);

        $posts = Post::find($id);

        $posts->commented = 1;

        $posts->save();

        return redirect('/post/'.$id);
    }
}
