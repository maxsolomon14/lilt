@extends('layout')
        @section('content')
                <div class="jumbotron">
                <h2 class="display-4">Blog Posts</h2>
                @if(count($posts) > 0)
                @foreach ($posts as $post)
                
                <ul class="list-group">
                        <li class="list-group-item">
                                @if (isset($post->user->image_path))
                                <a href="profile/{{$post->author_id}}"><img style="width:40px;height:40px;"src="{{asset($post->user->image_path)}}" class="rounded"></a>
                                @endif
                        
                                <h2><a href="/post/{{$post->id}}">{{$post->title}}</a></h2>
                                <small>Written by <a href="/profile/{{$post->author_id}}">{{$post->author_name}}</a> at {{$post->created_at->format('d/m/Y H:i')}}</small>
                        </li>
                </ul>
                
                @endforeach
                {{ $posts->links() }}
                @else
                <h2>No posts :(</h2>
                @endif
                </div>
        @endsection
