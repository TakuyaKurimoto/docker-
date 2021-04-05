
@extends('layouts.app')
@section('title', 'detail page')

@section('content')


    <div class="container mt-4">
    @if(Auth::id() == $post->user_id)
        <div class="mb-4 text-right">
            <a class="btn btn-primary" href="{{ route('posts.edit', ['post' => $post]) }}">
                編集する
            </a>
            <form style="display: inline-block;" method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">削除する</button>
            </form>
    </div>
    @endif
        <div class="border p-4">
            <h1 class="h5 mb-4">
                タイトル:{{ $post->title }}&nbsp;投稿者：{{ $user->name }}
            </h1>
            
            <div class="card">
                <!--参考https://qol-kk.com/wp2/blog/2020/01/22/post-1471/　-->
                <?=$post->body;?>    
            </div>
            
            <div class="row justify-content-center">
            @auth
                        <like-component
                            :post="{{ json_encode($post)}}"
                        ></like-component>
            @endauth
            
            </div>

            <section>
                <h2 class="h5 mb-4">
                    コメント
                </h2>
                @forelse($post->comments as $comment)
                    <div class="border-top p-4">
                        <time class="text-secondary">
                            {{ $comment->created_at->format('Y.m.d H:i') }}
                        </time>
                        <p class="mt-2">
                            {!! nl2br(e($comment->body)) !!}
                        </p>
                    </div>
                @empty
                    <p>コメントはまだありません。</p>
                @endforelse
            </section>
            <form class="mb-4" method="POST" action="{{ route('comments.store') }}">
                @csrf
                <input
                    name="post_id"
                    type="hidden"
                    value="{{ $post->id }}"
                >

                <div class="form-group">
                    <textarea
                        id="body"
                        name="body"
                        class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"
                        rows="4"   
                        placeholder="コメントを入力" 
                    >{{ old('body') }}</textarea>
                        @if ($errors->has('body'))
                        <div class="invalid-feedback">
                            {{ $errors->first('body') }}
                        </div>    
                        @endif
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        コメントする
                    </button>
                </div>
            </form>
        </div>
    </div>

  
@endsection