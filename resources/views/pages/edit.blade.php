@extends('layout')

@section('content')
    @if (Auth::user()->id != $edit_post->author_id)
    <h2 style="color:red">You cannot edit {{$edit_post->author_name}}'s post!</h2>
    @else
    <div class="jumbotron">
        <h2 class="display-4">Edit Post</h2>

        <form class="" method="post" action="/update/{{ $edit_post->id }}">
            @csrf
            Title:<br>
            <input type="text" name="title" value="{{ $edit_post->title }}"><br>
            Body:<br>
            <textarea name="body">{{ $edit_post->body }}</textarea><br>
            <button class="btn btn-primary" type="submit">Save Post</button>
        </form>
    </div>
    @endif

@endsection