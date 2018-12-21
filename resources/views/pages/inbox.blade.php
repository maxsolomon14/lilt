@extends('layout')
@section('content')
    @if ($userNow->id == $users['sender_id'])

    <div class="jumbotron">
        <inbox-component :conversation="{{ json_encode($conversation) }}" :conversation-not-empty="{{ json_encode(! empty($conversation)) }}" :user-now="{{ $userNow->id }}" :user-info="{{ $userInfo }}"></inbox-component>
            @if(isset($errors))

                @foreach ($errors->all() as $error)

                    <h4 style="color:red">{{$error}}</h4>

                @endforeach
            @endif
        @if($userNow->id == $users['sender_id'])
            <form style="max-width: 35rem; margin: 0 auto;" class="form-group" method="POST" action="{{route('send', ['sender_id' => $users['sender_id'], 'recipient_id' => $users['recipient_id'], ])}}">
                @csrf
                <label for="message">Send Message</label><br>
                <textarea class="form-control" name="message" placeholder="Send a message..."></textarea><br>
                <input type="submit" class="btn btn-primary">

            </form>
        </div>
        @else
            <form class="from-group" method="POST" action="{{route('send', ['sender_id' => $users['recipient_id'], 'recipient_id' => $users['sender_id'], ])}}">
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
