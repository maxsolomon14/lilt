<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Validator;

class PagesController extends Controller
{
    public function index()
    {
        if ($user = Auth::user()) {

            $userspost = Post::where('author_id', Auth::user()->id)->latest()->get();

            return view('pages.index')->withUserspost($userspost);
        }

        return view('pages.index');
    }

    public function posts()
    {
        return view('pages.posts');
    }

    public function login()
    {
        return view('pages.login');
    }

    public function profile(User $user)
    {
        $user_posts = $user->posts;

        if (Auth::user()->id === $user->id) {
            return redirect('/');
        }

        return view('pages.profile')->withUser($user);
    }

    public function search(Request $request)
    {
        //    dd($request->all());
        $validator = Validator::make($request->all(), [
            'search'      => 'required|max:20',
            'search_type' => 'required',
        ]);

        if ($request->search == null or $request->search_type == null) {
            return redirect(url()->previous());
        }

        if (!$validator->fails()) {
            $criteria = $request->search;

            if ($request->search_type === 'users') {
                $user = User::search($criteria)->first();
                if (!$user) {
                    return redirect(url()->previous());
                }

                return redirect('/profile/'.$user->id);
            }

            if ($request->search_type === 'post') {
                $post = Post::search($criteria)->first();

                if (!$post) {
                    return redirect(url()->previous());
                }

                return redirect('/post/'.$post->id);
            }

            return redirect(url()->previous());
        }
    }

    public function profiles()
    {
        $profiles = User::all();

        return view('pages.results')->with('profiles', $profiles);
    }

    public function image()
    {
        return view('pages.image');
    }

    public function image_up(User $user, Request $request)
    {
        if ($request->file('image') == null) {
            return redirect(url()->previous());
        }
        $path = $request->file('image')->store('/public/profile');
        $path = str_replace('public/', 'storage/', $path);

        $user->image_path = $path;
        $user->save();

        return redirect('/');
    }
}
