@extends('layouts.app')

@section('kensaku')

<form action="{{url('/')}}" method="GET">
<input type="text" name="keyword" placeholder="タグで検索"　value="{{$keyword}}"><input type="submit" value="検索">&nbsp; 
</form>

@endsection
@section('content')





@if($posts->count())


<div class="container">
<div class="row justify-content-center">
    <div class="col-md-4">
        人気記事ランキング
        @foreach ($countLike as $post)
            <div class="card mb-4">
                <div class="card-header">
                    <a class="card-link" href="{{ route('posts.show', ['post' => $post]) }}">
                    {{ $post->title }}
                    </a>
                    {{ $post->created_at->format('Y.m.d') }}{{$post->users_count}}
                    <Index-component
                            :post="{{ json_encode($post)}}"
                        ></Index-component>
                </div>
            </div>
        @endforeach 
　　　　　
    </div>
　　
   <div class="col-md-8">
    
        @foreach ($posts as $post)
            <div class="card mb-4">
                <div class="card-header">
                    <a  class="card-link"  href="{{ route('users.show',$post->user->id )}}">
                    <img src="/storage/user/{{ $post->user->thumbnail }}" class="thumbnail">
                    {{ $post->user->name }}
                    <a>さんが{{ $post->created_at->format('Y年m月d日') }}に投稿
                 </div>   
                 
                 
                 
                <div class="card-header">    
                    <a class="card-link" href="{{ route('posts.show', ['post' => $post]) }}">
                        {{ $post->title }}
                        
                    </a>
                </div>
                <div class="card-header">
                    タグ：{{ $post->tag }}<br>
                
                
                
                    
                    @if ($post->comments()->count())
                        <span class="badge badge-primary">
                            コメント {{ $post->comments()->count() }}件
                        </span>
                    @endif
                    　　
                            <Index-component
                                :post="{{ json_encode($post)}}"
                            ></Index-component>
                    
                </div>
                    


                
            
            </div>
        @endforeach
        
    <div class="d-flex justify-content-center">
    {{ $posts->links('pagination::bootstrap-4') }}
　　</div>
   </div>
    </div>

    @else
<p>見つかりませんでした。</p>
@endif

@endsection

