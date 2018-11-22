@extends('layout')

@section('content')


@foreach($profile as $user)
<div class="jumbotron">
    <h2 class="display-4">{{$user->name}}</h2>
    <p>{{$user->name}} has been a member of BBB since {{$user->created_at->format('Y')}}.</p>

    @if(count($user->posts) > 0)
    <h3>Here are {{$user->name}}'s posts:</h3>

    @foreach ($user->posts as $post)
    <ul class="list-group">
        <li class="list-group-item">
            <small>Written at {{$post->created_at->format('d/m/Y H:i')}}</small>
            <h2><a href="/post/{{$post->id}}">{{$post->title}}</a></h2>
        </li>
    </ul>
    @endforeach

    <h3>Here are all of {{$user->name}}'s comments:</h3>

    @foreach ($user->comments as $comment)
    <ul class="list-group">
        <li class="list-group-item">
            <small>Written by <a href="/profile/{{$comment->user_id}}">{{$comment->user_name}}</a> on {{$comment->created_at->format('d F Y')}}  -  Go to <a href="../post/{{$comment->post_id}}">post?</a></small><br>   
        {{$comment->comment}}
        </li>
    </ul>
    @endforeach
    @else
    <h2 class="lead">{{$user->name}} doesn't have any posts yet!</h2>
    @endif
</div>
@endforeach
@endsection