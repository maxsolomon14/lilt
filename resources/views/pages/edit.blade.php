@extends('layout')

@section('content')
    @if (Auth::user()->id != $editPost->author_id)
    <h2 style="color:red">You cannot edit {{$editPost->author_name}}'s post!</h2>
    @else
    <div class="jumbotron">
        <h2 class="display-4">Edit Post</h2>

        <form class="form-group" method="post" action="/update/{{ $editPost->id }}">
            @csrf
            Post Title:<br>
            <input class="form-control" type="text" name="title" value="{{ $editPost->title }}"><br>
            Post Content:<br>
            <textarea class="form-control" name="body">{{ $editPost->body }}</textarea><br>
            <button class="btn btn-primary" type="submit">Save Post</button>
        </form>
    </div>
    @endif

@endsection
