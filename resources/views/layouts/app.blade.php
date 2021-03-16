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
    @if (Route::currentRouteName() != 'posts.index')
    <div class="content__button">
        <a href="{{ route('posts.index') }}" class="button button_blue">Back to main page</a>
    </div>
    @endif
    @yield('content')
</div>
<script src="/js/app.js"></script>
</body>
</html>
