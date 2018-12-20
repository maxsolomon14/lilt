@extends('layout')

@section('content')
    <div class="jumbotron">
        <messages-component :messages="{{$messages}}" :messages-not-empty="{{json_encode($messages->isNotEmpty())}}" :current-user-id="{{ Auth::user()->id }}"></messages-component>

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
