@extends('layouts.app')
@section('title','ユーザー情報')
@section('content')
<div class="container">
  <table class="table table-striped table-hover">
  <thead>
  <tr>
    <th></th>
    
    <th>名前</th>
    
    <th></th>
  </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <div>
        @if(!empty($user->thumbnail))
        <img src="/storage/user/{{ $user->thumbnail }}" class="thumbnail">
        @else
        画像なし
        @endif
        </div>
      </td>
      
      <td>{{ $user->name }}</td>
      
      <td>
      @if(Auth::id() == $user->id)
      <a href="{{ route('user.userEdit') }}" class="btn btn-primary btn-sm">編集</a>
      @endif
      </td>
    </tr>
  </tbody>
  </table>
</div>  




<div class="container">
<div class="row justify-content-center">
    
        
　　
   <div class="col-md-8">
    
        @foreach ($posts as $post)
        <div class="card mb-4">
                <div class="card-header">
                    <a  class="card-link"  href="{{ route('users.show',$user->id )}}">
                    <img src="/storage/user/{{ $user->thumbnail }}" class="thumbnail">
                    {{ $user->name }}
                    
                    <a>さんが{{ $post->created_at->format('Y年m月d日') }}に投稿
                 </div>   
                  
                 
                <div class="card-header">    
                <a class="card-link" href="{{ route('posts.show', ['post' => $post]) }}">
                        {{ $post->title }}
                        
                </a>
                </div>
                <div class="card-header">
                    タグ：{{ $post->tag }}
                </div>
                @if ($post->comments->count())
                        <span class="badge badge-primary">
                            コメント {{ $post->comments->count() }}件
                        </span>
                @endif
                
                    
                    
                    

                    


                
            
            </div>
        @endforeach
        
    
   </div>
    </div>

    

@endsection