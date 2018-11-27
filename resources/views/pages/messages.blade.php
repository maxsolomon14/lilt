@extends('layout')

@section('content')

    @if ($messages->isEmpty() == false)
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
    


    @else
        <h2 class="display-4">No messages yet</h2>
    @endif
        @if(isset($errors))

        @foreach ($errors->all() as $error)

        <h4 style="color:red">{{$error}}</h4>

        @endforeach
        @endif
        <h2 class="display-4">Create New Message</h2>
        <form class="" method="post" action="../create-message">
            @csrf
        To:<br>
            <select name="option">
                @foreach(App\User::all() as $option)
                @if($option->id !== Auth::user()->id)
                <option value="{{$option->id}}">{{$option->name}}</option>
                @endif
                @endforeach
            </select><br>
            Message:<br>
            <textarea name="message"></textarea><br>
            <br>
                  <button class="btn btn-primary" type="submit">Send Message</button>
        </form>
    </div>
@endsection
