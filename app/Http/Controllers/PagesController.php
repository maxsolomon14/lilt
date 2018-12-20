<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Guzzle;

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
                $user = User::search($criteria)->get();

                if (!$user) {
                    return redirect(url()->previous());
                }
                if(count($user) > 1) {
                    return view(profile-results)->withProfiles($user);
                } else {
                    $user = User::search($criteria)->first();
                    return redirect('/profile/' . $user->id);
                }
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

        $client = new \GuzzleHttp\Client(['base_uri' => 'https://uifaces.co/api',
                                          'headers' => array("X-API-KEY" => "778ed0f0b5be6bd6ad1cda86fcd674")]);
        $response = $client->request('GET', '?random&limit=10');
        $image = json_decode($response->getBody())[0]->photo;



        return view('pages.results')->with('profiles', $profiles)->withImage($image);
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
