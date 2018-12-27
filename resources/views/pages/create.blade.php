@extends('layout')

@section('content')
<div class="jumbotron">
@if(isset($errors))

@foreach ($errors->all() as $error)

<h4 style="color:red">{{$error}}</h4>

@endforeach
@endif

    <create-post-component></create-post-component>

</div>
@endsection
