@extends('layout')

@section('content')
    <div class="jumbotron">
        <messages-component :messages="{{$messages}}" :all-users="{{ json_encode($findUser) }}" :messages-not-empty="{{json_encode($messages->isNotEmpty())}}" :current-user-id="{{ Auth::user()->id }}"></messages-component>

        @if(isset($errors))

        @foreach ($errors->all() as $error)

        <h4 style="color:red">{{$error}}</h4>

        @endforeach
        @endif
    </div>
@endsection
