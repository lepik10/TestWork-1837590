<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div class="content">
        <div class="posts">
            <h1>Posts</h1>
            @if($posts->count() > 0)
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
                        <tr>
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
                                <a href="/" class="button button_blue">Show</a>
                                <a href="/" class="button button_green">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                No posts
            @endif
        </div>
    </div>
</body>
</html>
