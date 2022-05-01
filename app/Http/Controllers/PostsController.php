<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\User;
use App\Post;
use App\Follow;

class PostsController extends Controller
{
    public function index(){
        $lists = Post::query()->whereIn('user_id', Auth::user()->follows()->pluck('followed_id'))
        ->orWhere('user_id', Auth::user()->id)->latest()->get();
        return view('posts.index',['list'=>$lists]);
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post' => 'required|min:1|max:200',
        ]);


        $post = $request->input('newPost');
        $request-> user_id = $request->user()->id;
        \DB::table('posts')->insert([
            'post' => $post,
            'user_id' => Auth::id()
        ]);
        return redirect('/top');
    }


    public function updateForm($id)
    {
        $post = \DB::table('posts')
            ->where('id', $id)
            ->first();
        return view('/top', compact('post'));
    }

     public function update(Request $request,$id)
    {

        $up_post = $request->input('upPost');
        \DB::table('posts')
            ->where('id', $id)
            ->update(
                ['post' => $up_post]
            );

        return redirect('/top');
    }
      public function delete($id)
    {
        \DB::table('posts')
            ->where('id', $id)
            ->delete();

        return redirect('/top');
    }


 public function userprofile(User $user,$id){
        $user = User::find($id);
        $posts = Post::where('user_id', $id)->orderBy('created_at', 'desc')->get();

        return view('users.userprofile',compact('user'),['posts'=>$posts]);
    }
}
