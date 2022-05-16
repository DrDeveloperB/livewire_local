<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<div>
    <a href="{{ route('posts.create') }}">글쓰기</a>
</div>

<div class="my-2">
    @foreach($posts as $post)
        <div class="rounded border shadow p-3 my-2">
            <div class="flex justify-between my-2">
                <div class="flex">
                    <p class="font-bold text-lg ">
                        {{ $post->id }} : {{ $post->title }}
                    </p>
                    <p class="mx-3 py-1 text-xs text-grey-500 font-semibold">
                        {{ $post->created_at->diffForHumans() }}
                    </p>
                </div>
            </div>

            <p class="text-grey-800">
                {!! $post->body !!}
            </p>
        </div>
    @endforeach
</div>

</body>
</html>

<?php
//echo "<xmp>";
//print_r($posts);
//echo "</xmp>";
