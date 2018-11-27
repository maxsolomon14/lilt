<?php
namespace App\Http\Controllers;
use Validator;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Comment;
use Illuminate\Http\Request;
class PagesController extends Controller
{
    public function index()
    {
        if($user = Auth::user()) {
            // $user_posts = Post::where('author_id', Auth::user()->id)->get();
            
            // $user_posts = Post::where('author_id', Auth::user()->id)->get();
            // $user_comments = Comment::where('user_id', Auth::user()->id)->get();
            // dd(Post::find(Auth::user()->id)->comments);
            // if($user_posts->isNotEmpty() && $user_comments->isNotEmpty()) {
                // return view('pages.index')->with('user_posts', $user_posts)->with('user_comments', $user_comments);
            // } else {
            //     $user_posts = [];
                return view('pages.index')->with('user_posts', $user->posts);
            // }
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
    public function profile($id) {
        
        $profile = User::where('id', $id)->get();
        // $profile_posts = Post::where('author_id', $id)->get();
        // $profile_comms = Comment::where('user_id', $id)->get();
        
        return view('pages.profile')->with('profile', $profile);
    }
    public function search(Request $request)
    {
    //    dd($request->all());
        $validator = Validator::make($request->all(), [
            'search' => 'required|max:20',
            'search_type' => 'required',
        ]);

            if($request->search == null or $request->search_type == null) {
                return redirect(url()->previous());
            }

        if(! $validator->fails()) {
            $criteria = $request->search;
            
        if($request->search_type === 'users') {
        $user = User::where('name', 'like', '%'.$criteria.'%')->first();
        return redirect('/profile/'.$user->id);
        } 
        

        if($request->search_type === 'post') {
            $user = Post::where('title', 'like', '%'.$criteria.'%')->first();
            return redirect('/post/'.$user->id);
        } 
            return redirect(url()->previous());
        
    }
        }
      
        
    
    public function profiles() {
        $profiles = User::all();
        
        
        return view('pages.results')->with('profiles', $profiles);
    }
    public function image() {
        return view('pages.image');
    }
    
    public function image_up(Request $request, $id) {
        if ($request->file('image') == null) {
            return redirect(url()->previous());
        }
        $path = $request->file('image')->store('/public/profile');
       $path = str_replace("public/", "storage/", $path);
        
       // echo $path;
        // dd($path);
       $image_path = User::find($id);
       $image_path->image_path = $path;
       $image_path->save();
       return redirect('/');
    }
    
}