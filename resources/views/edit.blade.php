@extends('layouts.app')

@section('content')

    <h1>Edit post</h1>

    @if(session('success_update'))
        <div class="message message_success">{{ session('success_update') }}</div>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="POST" class="form" enctype="multipart/form-data">
        @method('PUT')
        @include('_form')
        <input type="submit" class="button button_green" value="Change">
    </form>

    <form action="{{ route('posts.destroy', $post->id) }}" class="form_delete" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" class="button button_red" value="Delete">
    </form>

@endsection
