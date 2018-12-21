@extends('layout')

@section('content')

    <profiles-component image="{{ $image }}" :profiles="{{ json_encode($profiles) }}" :user-now="{{ $userNow->id }}"></profiles-component>

@endsection
