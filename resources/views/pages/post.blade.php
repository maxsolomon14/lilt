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
        <small>Written by <a href="{{route('profile', $post->author_id)}}">{{$post->author_name}}</a> on {{$post->created_at->format('d F Y H:i')}}</small>
        <like-component v-bind:elf="{{ json_encode($post->author_id == $userNow->id) }}" users-post="{{ $userspost }}" logic="{{ $logic }}"></like-component>
        <comment-component v-bind:commented="{{ json_encode($post->commented != null) }}" :all-comments="{{ $post->comments }}"></comment-component>
        @if ($userNow->id === $post->author_id)
        <br>
        <form action="{{route('image_up', $post->id)}}" method="post" enctype="multipart/form-data">
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
        <a href="{{route('edit_post', $post->id)}}" class="btn btn-primary">Edit Post</a>
        @if (isset($post->image_path))<a href="{{route('delete_post', $post->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete Image</a>@endif
        <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{route('delete_post', $post->id)}}">Delete Post</a>
        @endif
        @if($userNow->name != $post->author_name)
        <h3>Add a comment:</h3>
        @if(isset($errors))
        @foreach ($errors->all() as $error)
            <h4 style="color:red">{{$error}}</h4>
        @endforeach
        @endif
        <form class="form-group" action="{{route('comment', $post->id)}}" method="POST">
            @csrf
        <textarea class="form-control" name="comment"></textarea><br>
        <button class="btn btn-primary" type="submit">Add Comment</button>
        </form>
        @endif
        
    @else
        <h2>Post does not exist</h2>
    @endif
        </div>
    </div>
@endsection
