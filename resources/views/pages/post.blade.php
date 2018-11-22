@extends('layout')

@section('content')

    <div class="container-fluid">
    @if(count($post) > 0)
        @foreach($post as $blog_post)
        <div class="jumbotron">
        <h2 class="display-4">{{$blog_post->title}}</h2>
        @if(isset($blog_post->image_path))
        <img class="img-fluid" src="{{asset($blog_post->image_path)}}">
        @endif
        <p class="lead">{{$blog_post->body}}</p>
        <small>Written by <a href="/profile/{{$blog_post->author_id}}">{{$blog_post->author_name}}</a> on {{$blog_post->created_at->format('d F Y H:i')}}</small>

        @if($blog_post->commented != null)
        <h3>Comments:</h3><br>
        @foreach($comments as $comment)
        <ul class="list-group">
            <li class="list-group-item">
                <small>Written by <a href="/profile/{{$comment->user_id}}">{{$comment->user_name}}</a> on {{$comment->created_at->format('d F Y')}}</small><br>
                {{$comment->comment}}
            </li>
        </ul>
        @endforeach
        @endif
        @if (Auth::user()->id === $blog_post->author_id)
        <br>
        <form action="../image/{{$blog_post->id}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <button type="submit" class="input-group-text">Upload</button>
                </div>
                <div class="custom-file">
                  <input type="file" name="image" class="custom-file-input" id="image">
                  <label class="custom-file-label" for="image">Add Image to Post:</label>
                </div>
              </div>
        </form>
        <a href="../edit/{{$blog_post->id}}" class="btn btn-primary">Edit Post</a><br><br>
        <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="../delete/{{$blog_post->id}}">Delete</a>
        @endif
        @if(Auth::user()->name != $blog_post->author_name)
        <h3>Add a comment:</h3>
        @if(isset($errors))
        @foreach ($errors->all() as $error)
            <h4 style="color:red">{{$error}}</h4>
        @endforeach
        @endif
        <form action="/comment/{{$blog_post->id}}" method="POST">   
            @csrf
        <textarea name="comment"></textarea><br>
        <button class="btn btn-primary" type="submit">Add Comment</button>
        </form>
        @endif
        @endforeach
    @else
        <h2>Post does not exist</h2>
    @endif
        </div>
    </div>
@endsection