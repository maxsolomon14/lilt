@extends('layout')

@section('content')
    @if (isset($messages))
    <div class="jumbotron">
        <h2 class="display-4">Messages</h2>
    @foreach ($messages as $inbox)
    
            <ul class="list-group">
                <li class="list-group-item">
                <h2><a href="../inbox/{{$inbox->sender_id}}/{{$inbox->recipient_id}}">{{$message->name}}</a></h2>
                    <small>At {{$inbox->created_at->format('d F Y H:i')}}</small>
                </li>
            </ul>
    @endforeach
    </div>


    @else
        <h2>No messages yet :(</h2>
    @endif
@endsection
