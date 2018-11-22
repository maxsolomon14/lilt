@extends('layout')

@section('content')

    <div class="jumbotron">
        <h2 class="display-4">Profiles</h2>
    @foreach ($profiles as $profile)
        <ul class="list-group">
            <li class="list-group-item">
                <a href="../profile/{{$profile->id}}">{{$profile->name}}</a> - Member since {{$profile->created_at->format('Y')}}. {{$profile->name}} @if(count($profile->posts) < 1) hasn't made any posts. @else  has made {{count($profile->posts)}} posts. @endif
            </li>
        </ul>
    @endforeach


    </div>



@endsection