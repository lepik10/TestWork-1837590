@extends('layouts.app')

@section('content')

    <h1>{{ $post->title }}</h1>
    <div class="post">
        <p class="post__date"><b>Created:</b> {{$post->created_at}}</p>
        <p><b>Theme:</b> {{$post->theme}}</p>
        @if($post->image)
        <div class="post__image">
            <img src="{{ $post->image_path }}" alt="{{ $post->title }}">
        </div>
        @endif
        <div class="post__text">
            {!! $post->content !!}
        </div>
    </div>

@endsection
