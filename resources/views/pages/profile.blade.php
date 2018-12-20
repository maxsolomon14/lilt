@extends('layout')

@section('content')
    <div class="jumbotron">
        <h2 class="display-4">{{$user->name}}</h2>
        @if (isset($user->image_path))
        <img style="width:200px;height:200px;"src="{{asset($user->image_path)}}" class="rounded"><br>
        @endif
        <p class="lead">{{$user->name}} has been a member of BBB since {{$user->created_at->format('Y')}}.</p>
        <a href="{{route('inbox', ['sender_id' => $userNow->id, 'recipient_id' => $user->id, ])}}" role="button" class="btn btn-primary">Chat with {{$user->name}}</a>
        <post-component :all-posts="{{$user->posts}}" :posted="{{ json_encode(count($user->posts) > 0) }}" user-name="{{ $user->name }}"></post-component>
        @if(count($user->comments) > 0)
            <h3>Here are all of {{$user->name}}'s comments:</h3>
        @foreach ($user->comments as $comment)
        <ul class="list-group">
            <li class="list-group-item">
                <small>Written by <a href="{{route('profile', $comment->user_id)}}">{{$user->name}}</a> on {{$comment->created_at->format('d F Y')}}  -  Go to <a href="{{route('post.show', $comment->post_id)}}">post?</a></small><br>
            {{$comment->comment}}
            </li>
        </ul>
        @endforeach
        @endif
    </div>
@endsection
