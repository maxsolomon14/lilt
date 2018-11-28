@extends('layout')


@section('content')
    <div class="jumbotron">
    @if(! Auth::check())
    <h1 class="display-4">Welcome</h1>
    <p class="lead">Please sign in below.</p>
        <a href="/login" class="btn btn-primary ml-auto">Login</a>
        <a href="/register" class="btn btn-secondary ml-auto">Register</a>
    
    @else
    
    <h2 class="display-4">Welcome to your profile {{$userNow->name}}!</h2>
    @if(! isset($userNow->image_path))
    <form action="../profile-pic/{{$userNow->id}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <button type="submit" class="input-group-text">Upload</button>
                </div>
                <div class="custom-file">
                  <input type="file" name="image" class="custom-file-input" id="image">
                  <label class="custom-file-label" for="image">Add a Profile Picture:</label>
                </div>
              </div>
        </form>
    @else
    <img style="width:200px;height:200px;"src="{{asset($userNow->image_path)}}" class="rounded"><br>
    <br><button class="btn btn-info" type="button" id="formButton">Change Profile Picture</button>

    <form id="form1" action="../profile-pic/{{$userNow->id}}" method="post" enctype="multipart/form-data">
        @csrf
        <br>
        <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <button type="submit" class="input-group-text">Upload</button>
                </div>
                <div class="custom-file">
                  <input type="file" name="image" class="custom-file-input" id="image">
                  <label class="custom-file-label" for="image">Add a Profile Picture:</label>
                </div>
              </div>
        </form>
    @endif
    @if(! $user_posts->isEmpty())
    <h3 class="lead">Take a look at your posts:</h3>

    @foreach($user_posts as $post)
        <ul class="list-group">
            <li class="list-group-item">
            <small>Written at {{$post->created_at->format('d/m/Y H:i')}}</small>
            <h2><a href="/post/{{$post->id}}">{{$post->title}}</a></h2>
        

        
    @foreach ($post->comments as $comment)
        <ul class="list-group">
            <li class="list-group-item">{{$comment->comment}} - by <a href="profile/{{$comment->user_id}}">{{$comment->user_name}}</a></li>
        </ul> 
    @endforeach
            </li>
        </ul>
    @endforeach
    @else
    <h2>Create your first post:</h2>
    @if(isset($errors))
    @foreach ($errors->all() as $error)
    <h4 style="color:red">{{$error}}</h4>
    @endforeach
    @endif
    <form class="" method="post" action="/store">
        @csrf
            Title:<br>
            <input type="text" name="title"><br>
            Body:<br>
            <textarea name="body"></textarea><br>
            <button class="btn btn-primary" type="submit">Create Post</button>
    </form>    
    @endif
    @endif
    </div>
@endsection

