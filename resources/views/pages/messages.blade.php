@extends('layout')

@section('content')

    @if ($messages->isNotEmpty())
    <div class="jumbotron">
        <h2 class="display-4">Messages</h2>
    @foreach ($messages as $inbox)
    
    @if ($inbox->sender_id !== $userNow->id)


   
            <ul class="list-group">
                <li class="list-group-item">
                <h2><a href="{{route('inbox', ['sender_id' => $inbox->recipient_id, 'recipient_id' => $inbox->sender_id, ])}}">@if ($userNow->id !== $inbox->sender_id){{$findUser->where('id', $inbox->sender_id)->first()->name}} @else {{$findUser->where('id', $inbox->recipient_id)->first()->name}} @endif</a></h2>
                <small>At {{$inbox->created_at->format('d F Y H:i')}}</small>
                </li>
            </ul>
    @else
    <ul class="list-group">
        <li class="list-group-item">
        <h2><a href="{{route('inbox', ['sender_id' => $inbox->sender_id, 'recipient_id' => $inbox->recipient_id, ])}}">@if ($userNow->id !== $inbox->sender_id){{$findUser->where('id', $inbox->sender_id)->first()->name}} @else {{$findUser->where('id', $inbox->recipient_id)->first()->name}} @endif</a></h2>
            <small>At {{$inbox->created_at->format('d F Y H:i')}}</small>
        </li>
    </ul>
    @endif
    @endforeach
    


    @else
        <h2 class="display-4">No messages yet</h2>
    @endif
        @if(isset($errors))

        @foreach ($errors->all() as $error)

        <h4 style="color:red">{{$error}}</h4>

        @endforeach
        @endif
        <h2 class="display-4">Create New Message</h2>
        <form class="form-group" method="post" action="../create-message">
            @csrf
        To:<br>
            <select class="form-control" name="option">
                @foreach($findUser as $option)
                @if($option->id !== $userNow->id)
                <option value="{{$option->id}}">{{$option->name}}</option>
                @endif
                @endforeach
            </select><br>
            Message:<br>
            <textarea class="form-control" name="message"></textarea><br>
            <br>
                  <button class="btn btn-primary" type="submit">Send Message</button>
        </form>
    </div>
@endsection
