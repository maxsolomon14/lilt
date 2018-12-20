@extends('layout')
        @section('content')
                <div class="jumbotron">
                <h2 class="display-4">Blog Posts</h2>
                    <posts-component :all-posts="{{ json_encode($posts) }}" :posts-exist="{{ json_encode(count($posts) > 0) }}"></posts-component>
                    {{ $posts->links() }}
                </div>
        @endsection
