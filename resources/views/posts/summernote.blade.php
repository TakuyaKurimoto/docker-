@extends('layouts.app')
@section('title', 'create page')
@section('postContent')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>



<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
 
<div class="container mt-4">
        <div class="border p-4">
            <h1 class="h5 mb-4">
                投稿の新規作成
            </h1>

            <form method="POST" action="{{ route('posts.store') }}" name="ansform" enctype="multipart/form-data">
                @csrf

                <fieldset class="mb-4">
                    <div class="form-group">
                        <label for="title">
                            タイトル
                        </label>
                        <input
                            id="title"
                            name="title"
                            class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                            value="{{ old('title') }}"
                            type="text"
                        >
                        @if ($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="tag">
                            タグ
                        </label>
                        <input
                            id="tag"
                            name="tag"
                            class="form-control {{ $errors->has('tag') ? 'is-invalid' : '' }}"
                            value="{{ old('tag') }}"
                            type="text"
                        >
                        @if ($errors->has('tag'))
                            <div class="invalid-feedback">
                                {{ $errors->first('tag') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="body">
                            本文
                        </label>
                        <textarea id="summernote" name="body"></textarea>
                            @if ($errors->has('body'))
                          <div class="invalid-feedback">
                                {{ $errors->first('body') }}
                          </div>
                            @endif
                    </div>

                    <div class="mt-5">
                        <a class="btn btn-secondary" href="{{ route('top') }}">
                            キャンセル
                        </a>
                        <input type="submit" class="btn btn-primary" name="subbtn">
                        
                    </div>
                </fieldset>
            </form>
        </div>
    </div>


<script>
    jQuery(document).ready(function($) {
    $('#summernote').summernote({
        tabsize: 2,
        height: 500,
 
  
     callbacks: {
      onImageUpload : function(files, editor, welEditable) {
         for(var i = files.length - 1; i >= 0; i--) {
                 sendFile(files[i], this);
          }
      }
     } 
 });
 
  function sendFile(file, el) {
    var form_data = new FormData();
    form_data.append('file', file);
    
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: form_data,
      type: "POST",
      contentType: 'multipart/form-data',
      // 画像保存用のルート設定
      url: 'temp',
      cache: false,
      contentType: false,
      processData: false,
      success: function(url) {
        $(el).summernote('editor.insertImage', url);
      }
    });
  }
});
</script>
  
@endsection
