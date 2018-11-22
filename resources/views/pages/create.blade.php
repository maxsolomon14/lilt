@extends('layout')

@section('content')
<div class="jumbotron">
<h2 class="display-4">Create a Post</h2>
@if(isset($errors))

@foreach ($errors->all() as $error)

<h4 style="color:red">{{$error}}</h4>

@endforeach
@endif

<form class="" method="post" action="/store">
    @csrf
    Title:<br>
    <input type="text" name="title"><br>
    Body:<br>
    <textarea name="body"></textarea><br>
    <button class="btn btn-primary" type="submit">Create Post</button>
</form>
@endsection
