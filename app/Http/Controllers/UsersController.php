<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;
use App\User;
use App\Post;
use App\follow;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }

    public function search(Request $request){

        $keyword = $request->input('name');
        $query = User::query();

        if (!empty($keyword)) {
            $query->where('username', 'LIKE', "%{$keyword}%");
        }

        $user = $query->orderBy('id', 'desc')->get();
        return view('users.search', compact('user','keyword'));
    }

     public function index(){
         $user = \DB::table('users')->get();
        return view('users.search',['user'=>$user]);
    }

public function follow(Request $request)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($request->follow);
        if(!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($request->follow);
        }
        return back();
    }

    public function unfollow(Request $request)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($request->unfollow);
        if($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($request->unfollow);
        }
        return back();

    }

    public function profileupdate(Request $request){
        $validator = Validator::make($request->all(),[
          'username'  => 'required|min:2|max:12',
          'mail' => ['required', 'min:5', 'max:40', 'email', Rule::unique('users')->ignore(Auth::id())],
          'newpassword' => 'min:8|max:20|confirmed|alpha_num',
          'newpassword_confirmation' => 'min:8|max:20|alpha_num',
          'bio' => 'max:150',
          'iconimage' => 'file|image|mimes:jpeg,png,bmp,gif,svg',
        ]);

        $user = Auth::user();
        //画像登録
        $validator->validate();
        $user->update([
            'username' => $request->input('username'),
            'mail' => $request->input('mail'),
            'bio' => $request->input('bio'),
        ]);
        if($request->input('newpassword')) {
            $user->update([
            'password' => bcrypt($request->input('newpassword')),
            ]);

            if($request->file('iconimage') ) {
                $image = $request->file('iconimage')->store('public/images');
                $user->update([
                    'images' => basename($image),
                ]);
        return redirect('/profile');
    }
    }
    return redirect('/profile');
}
}
