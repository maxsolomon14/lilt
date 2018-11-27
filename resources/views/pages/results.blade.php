@extends('layout')

@section('content')

    <div class="jumbotron">
        <h2 class="display-4">Profiles</h2>
    @foreach ($profiles as $profile)
        @if(Auth::user()->id !== $profile->id)
        <ul class="list-group">
            <li class="list-group-item">
                    @if (isset($profile->image_path))
                    <img style="width:40px;height:40px;"src="{{asset($profile->image_path)}}" class="rounded">
                    @endif
                    <p class="lead"><a href="../profile/{{$profile->id}}">{{$profile->name}}</a> - Member since {{$profile->created_at->format('Y')}}. {{$profile->name}} @if(count($profile->posts) < 1) hasn't made any posts. @else  has made {{count($profile->posts)}} posts. @endif</p>
            </li>
        </ul>
        @endif
    @endforeach


    </div>



@endsection