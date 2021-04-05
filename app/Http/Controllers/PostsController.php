<?php

namespace App\Http\Controllers;

use App\Post;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        

        $query = Post::query();
        
        $keyword = $request->keyword;
        if (!empty($keyword)) {
            $query->where('tag', 'LIKE', "%{$keyword}%");       
        
            $posts = $query->orderBy('created_at', 'desc')->paginate(5);
        }
        else{
            $posts = Post::with('user')->orderBy('created_at', 'desc')->paginate(5);
        }
        //記事をいいね数で並び替え
        //参考https://qiita.com/Ioan/items/bac58de02b826ae8e9e9
        $countLike = Post::withCount('users')
        ->orderBy('users_count', 'desc')
        ->take(5)
        ->get();
        
        return view('posts.index', compact('posts', 'keyword','countLike',));
        
        
    }

/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        //return view('posts.create');
        return view('posts.summernote');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $id = Auth::id();
        //インスタンス作成
        $request->validate([
            'title' => 'required|max:50',
            'body' => 'required|max:2000',
            'tag'  => 'required|max:50',
        ]);

        
        $post = new Post();
        
        $post->body = $request->body;
        $post->user_id = $id;
        $post->title = $request->title;
        $post->tag = $request->tag;
        $post->save();
        return redirect()->to('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post_id)
    {
        
        $post = Post::findOrFail($post_id);
        
        $usr_id = $post->user_id;
        $user = User::where('id', $usr_id)->first();
        //コメントテーブルの値も$postから参照できる

        return view('posts.show',['post' => $post,'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.edit',['post' => $post,'id' =>$id]);     
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->post_id;
        
        //レコードを検索
        $post = Post::findOrFail($id);
        
        $post->body = $request->　body;
        $post->tag = $request->tag;
        $post->title = $request->title;
        
        //保存（更新）
        $post->save();
        
        return redirect()->to('/');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id)
    {
        $post = Post::findOrFail($post_id);

    \DB::transaction(function () use ($post) {
        $post->comments()->delete();
        $post->delete();
    });    
    return redirect()->to('/');

    }
   
   
    public function image (Request $request){
        $result=$request->file('file')->isValid();
        if($result){
            $filename = $request->file->getClientOriginalName();
            $file=$request->file('file')->move('temp', $filename);
            echo '/temp/'.$filename;
        }
    }
    


}

