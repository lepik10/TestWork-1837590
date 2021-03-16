@extends('layouts.app')

@section('content')

    <h1>Create new post</h1>

    <form action="{{ route('posts.store') }}" method="POST" class="form" enctype="multipart/form-data">
        @include('_form')
        <input type="submit" class="button button_green" value="Create">
    </form>

@endsection
