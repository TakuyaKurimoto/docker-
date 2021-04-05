<!-- Quill -->
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
@extends('layouts.app')
@section('title', 'create page')
@section('postContent')



<div class="row">
        <!-- メイン -->
        <div class="col-10 col-md-6 offset-1 offset-md-3">

        <form action="/newpostsend" method="post">
            @csrf
            <p>タイトル</p>
            <input type="text" name="title" class="formtitle">         
            <p>&nbsp;</p>
            <p>本文</p>
            <!-- <textarea name="main" cols="40" rows="10"></textarea> -->
            <div id="editor" style="height: 200px;" name="body"
                            class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"
                            rows="4"></div>
            <p>&nbsp;</p>
            <input type="submit" class="submitbtn">
        </form>
    </div>
</div>

    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });
    </script>

    @endsection


