@extends('layout')

@section('content')
    @if (isset($messages))
    <div class="jumbotron">
        <h2 class="display-4">Messages</h2>
    @foreach ($messages as $inbox)
    
    @if ($inbox->sender_id !== Auth::user()->id)
       
   
            <ul class="list-group">
                <li class="list-group-item">
                <h2><a href="../inbox/{{$inbox->recipient_id}}/{{$inbox->sender_id}}">@if (Auth::user()->id !== $inbox->sender_id){{App\User::find($inbox->sender_id)->name}} @else {{App\User::find($inbox->recipient_id)->name}} @endif</a></h2>
                <small>At {{$inbox->created_at->format('d F Y H:i')}}</small>
                </li>
            </ul>
    @else
    <ul class="list-group">
        <li class="list-group-item">
        <h2><a href="../inbox/{{$inbox->sender_id}}/{{$inbox->recipient_id}}">@if (Auth::user()->id !== $inbox->sender_id){{App\User::find($inbox->sender_id)->name}} @else {{App\User::find($inbox->recipient_id)->name}} @endif</a></h2>
            <small>At {{$inbox->created_at->format('d F Y H:i')}}</small>
        </li>
    </ul>
    @endif
    @endforeach
    </div>


    @else
        <h2>No messages yet :(</h2>
    @endif
@endsection
