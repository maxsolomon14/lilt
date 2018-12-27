@extends('layout')

@section('content')

    
    <div class="container-fluid">
    @if($post !== null)
    
        <div class="jumbotron">
        <post-component :single-post="true" :post="{{ $post }}" :image-exist="{{ json_encode(isset($post->image_path)) }}"></post-component>
        <like-component :post-id="{{ $post->id }}" :user-id="{{ $userNow->id }}" :elf="{{ json_encode($post->author_id == $userNow->id) }}" :has-liked="{{ json_encode($hasLiked) }}" post-user="{{ $post->author_name }}" :likes-amount="{{ count($post->likes) }}" users-post="{{ $userspost }}"></like-component>
        <comment-component :user="{{ $userNow }}" :commented="{{ json_encode($post->comments->isNotEmpty()) }}" :all-comments="{{ $post->comments }}" :not-users-post="{{ json_encode($userNow->name != $post->author_name) }}" :post="{{ $post }}"></comment-component>
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
        @if (isset($post->image_path))<a href="{{route('delete_image', $post->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete Image</a>@endif
        <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{route('delete_post', $post->id)}}">Delete Post</a>
        @endif
            @if(isset($errors))
                @foreach ($errors->all() as $error)
                    <h4 style="color:red">{{$error}}</h4>
                @endforeach
            @endif
    @else
        <h2>Post does not exist</h2>
    @endif
        </div>
    </div>
@endsection
