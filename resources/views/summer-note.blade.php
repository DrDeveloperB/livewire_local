@extends('layouts.base')

@section('content')

    <div class="flex justify-center">

        <div class="my-10 flex">
            <div class="p-2 rounded border">
                <div class="">
                    <label for="content" class="">Content</label>
                    <textarea name="content" id="content" class="">
                        {{ $po->po_content }}
                    </textarea>
                </div>
            </div>
        </div>

    </div>



    <div class="container mt-5">
        <h1>Laravel Summernote Editor Image Upload Example - ItSolutionStuff.com</h1>
        <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ $post->title }}" />
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea id="summernote" name="body">
                    {{ $post->body }}
                </textarea>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-success btn-block">Publish</button>
            </div>
        </form>
    </div>



    <script type="text/javascript">
        let editor;
        window.onload = function () {
            $('#content').summernote();

            $(document).ready(function () {
                // $('#content').summernote();
                $('#summernote').summernote({
                    height: 450,
                });
            });
        };

    </script>

@endsection
