<?php

namespace App\Http\Controllers;

use App\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    

    public function userEdit(Request $request){
        $authUser = Auth::user();

        return view('user.userEdit',compact('authUser'));
    }

    
    public function show($id)
    {
        
        $user = User::findOrFail($id);
        $posts = Post::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(5);
       

        return view('user.show',compact('posts', 'user'));
    }
    public function userUpdate(Request $request){
        // Validator check
        $request->validate([
            'name' => 'required',
            'thumbnail' => 'file|image|mimes:png,jpeg'
        ]);
        
    
        $uploadfile = $request->file('thumbnail');

          if(!empty($uploadfile)){
            $thumbnailname = $request->file('thumbnail')->hashName();
            $request->file('thumbnail')->storeAs('public/user', $thumbnailname);

            $param = [
                'name'=>$request->name,
                'thumbnail'=>$thumbnailname,
                
            ];
          }else{
               $param = [
                    'name'=>$request->name,
                    
               ];
          }
        $id = Auth::id();
        User::where('id',$id)->update($param);
        return redirect(route('user.userEdit'))->with('success', '保存しました。');
    }
}

