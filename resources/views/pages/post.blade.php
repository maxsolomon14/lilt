@extends('layout')

@section('content')

    <div class="container-fluid">
    @if($post !== null)
    
        <div class="jumbotron">
        <h2 class="display-4">{{$post->title}}</h2>
        @if(isset($post->image_path))
        <img class="img-fluid" src="{{asset($post->image_path)}}">
        @endif

        <p class="lead">{{$post->body}}</p>
        <small>Written by <a href="/profile/{{$post->author_id}}">{{$post->author_name}}</a> on {{$post->created_at->format('d F Y H:i')}}</small>
        
        @if ($post->author_id == Auth::user()->id)
        <p>{{$userspost}}</p>
        @else
        @if($post->likes->isEmpty())
        <p>{{$logUnliked}}</p> <a href="/like/{{$post->id}}/{{Auth::user()->id}}" class="btn btn-primary" role="button">Like</a>
        @else
        @if($hasLiked)
        <p>{{$logLiked}}</p> <a class="btn btn-secondary" role="button" href="/unlike/{{Auth::user()->id}}/{{$post->id}}">Unlike</a>
        @endif
        @endif
        @endif
        
        @if($post->commented != null)
        <h3>Comments:</h3><br>
        @foreach($post->comments as $comment)
        <ul class="list-group">
            <li class="list-group-item">
                <small>Written by <a href="/profile/{{$comment->user_id}}">{{$comment->user_name}}</a> on {{$comment->created_at->format('d F Y')}}</small><br>
                {{$comment->comment}}
            </li>
        </ul>
        @endforeach
        @endif
        @if (Auth::user()->id === $post->author_id)
        <br>
        <form action="../image/{{$post->id}}" method="post" enctype="multipart/form-data">
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
        <a href="../edit/{{$post->id}}" class="btn btn-primary">Edit Post</a>  
        <a href="../delete-image/{{$post->id}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete Image</a>  
        <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="../delete/{{$post->id}}">Delete Post</a>
        @endif
        @if(Auth::user()->name != $post->author_name)
        <h3>Add a comment:</h3>
        @if(isset($errors))
        @foreach ($errors->all() as $error)
            <h4 style="color:red">{{$error}}</h4>
        @endforeach
        @endif
        <form action="/comment/{{$post->id}}" method="POST">   
            @csrf
        <textarea name="comment"></textarea><br>
        <button class="btn btn-primary" type="submit">Add Comment</button>
        </form>
        @endif
        
    @else
        <h2>Post does not exist</h2>
    @endif
        </div>
    </div>
@endsection