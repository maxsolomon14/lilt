@extends('layout')

@section('content')
<div class="jumbotron">
<h2 class="display-4">Create a Post</h2>
@if(isset($errors))

@foreach ($errors->all() as $error)

<h4 style="color:red">{{$error}}</h4>

@endforeach
@endif

<form class="form-group" method="post" action="/store" enctype="multipart/form-data">
    @csrf
    Title:<br>
    <input class="form-control" type="text" name="title"><br>
    Body:<br>
    <textarea class="form-control" name="body"></textarea><br>
    <br>
    <div class="input-group mb-3">
            <div class="custom-file">
              <input type="file" name="image" class="custom-file-input" id="image">
              <label class="custom-file-label" for="image">Add a Picture:</label>
            </div>
          </div>
          <button class="btn btn-primary" type="submit">Create Post</button>
</form>
@endsection
