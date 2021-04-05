<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $post = Post::find($id);
        $post->users()->attach(Auth::id());//対応する投稿とユーザーを紐付ける
        $count = $post->users()->count(); 
        $result = true; 
        return response()->json([
            'result' => $result, 
            'count' => $count,  
        ]);

        
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->users()->detach(Auth::id());
        $count = $post->users()->count(); //以下追加
        $result = false;
        return response()->json([
            'count' => $count, 
        ]);
    }
    public function count ($id) //以下追加
    {
        $post = Post::find($id);
        $count = $post->users()->count();
        return response()->json($count);
    }
    public function hasfavorite ($id)
    {
        $post = Post::find($id);
        if ($post->users()->where('user_id', Auth::id())->exists()) {
            $result = true;
        } else {
            $result = false;
        }
        return response()->json($result);
    }
}
