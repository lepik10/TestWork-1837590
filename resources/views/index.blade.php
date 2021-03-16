@extends('layouts.app')

@section('content')
<h1>Posts</h1>
@if(session('success_create'))
    <div class="message message_success">{{ session('success_create') }}</div>
@endif
@if(session('success_delete'))
    <div class="message message_success">{{ session('success_delete') }}</div>
@endif
<div class="content__button">
    <a href="{{ route('posts.create') }}" class="button button_blue">Create new post</a>
</div>
<div class="posts">
    @if($posts->count() > 0)
        <div class="posts__total">Total posts: {{ $posts->count() }}</div>
        <table class="posts__items">
            <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>Theme</th>
                <th>Created</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr class="posts__item">
                    <td>{{ $post->id }}</td>
                    <td>
                        @if($post->image)
                            <img src="{{ $post->image_path }}" class="posts__image" alt="{{ $post->title }}">
                        @else
                            <span class="posts__noimage">No image</span>
                        @endif
                    </td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->theme }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td class="posts__buttons">
                        <a href="{{ route('posts.show', $post->id) }}" class="button button_blue">Show</a>
                        <a href="{{ route('posts.edit', $post->id) }}" class="button button_green">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        No posts
    @endif
</div>
@endsection
