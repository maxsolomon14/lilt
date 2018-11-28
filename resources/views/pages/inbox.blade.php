@extends('layout')
@section('content')
    @if ($userNow->id == $users['sender_id'])

    <div class="jumbotron">
        

        
        @if (! empty($conversation))

                    <h3 style="text-align: center;" class="display-4">Inbox with {{App\User::find($users['recipient_id'])->name}}</h3>
        @foreach ($conversation as $convo)

                <div class="card" style="max-width: 35rem; margin: 0 auto">
            <ul class="list-group">
        @if ($convo->sender_id === $userNow->id)
                
                <li class="list-group-item" style="float:right">
                    <h3 style="text-align: right;">You</h3>
                    <p style="text-align: right;">{{$convo->message}}</p>
                    <small style="float: right;">Sent at {{Carbon::parse($convo->created_at)->format('d F Y H:i')}} <a href="/delete-message/{{$convo->id}}">Unsend</a></small>
                </li>
        @else
                
                <li class="list-group-item" style="float:left">
                    <h3>{{App\User::find($convo->sender_id)->name}}</h3>{{$convo->message}}<br>
                    <small style="float:left">Sent at {{Carbon::parse($convo->created_at)->format('d F Y H:i')}}</small>
                </li>
        @endif
            </ul>
                </div>
        @endforeach
        @if(isset($errors))

        @foreach ($errors->all() as $error)
        
        <h4 style="color:red">{{$error}}</h4>
        
        @endforeach
        @endif
        @else
        <h3>You have no messages with this person, start a conversation below!</h3>
        @endif
        @if($userNow->id == $users['sender_id'])
            <form class="form-group" method="POST" action="/send/{{$users['sender_id']}}/{{$users['recipient_id']}}">
                @csrf
                <label for="message">Message</label><br>
                <textarea class="form-control" name="message" placeholder="Send a message..."></textarea><br>
                <input type="submit" class="btn btn-primary">

            </form>
        </div>
        @else
            <form class="from-group" method="POST" action="/send/{{$users['recipient_id']}}/{{$users['sender_id']}}">
                @csrf
                <label for="message">Message</label><br>
                <textarea class="form-control" name="message" placeholder="Send a message..."></textarea><br>
                <input type="submit" class="btn btn-primary">

            </form>
        </div>
        @endif
        @else
        <h2 style="color:red">Access denied.<a href="/messages" style="color:red"> Return to messages.</a></h2>
        @endif
        

@endsection
