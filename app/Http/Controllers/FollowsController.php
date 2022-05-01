<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Post;
use App\Follow;

class FollowsController extends Controller
{
    public function followList(Post $post, Follow $follow){
        $user = auth()->user();
        $users = $user->follows()->get();
        $follow_ids = $follow->followingIds($user->id);
        $following_ids = $follow_ids->pluck('followed_id')->toArray();
        $timelines = $post->getTimelines($user->id, $following_ids);
        return view('follows.followList',['timelines' => $timelines,'users'=>$users]);
    }

    public function followerList(Post $post, Follow $follow){
        $user = auth()->user();
        $users = $user->followers()->get();
        $follow_ids = $follow->followedIds($user->id);
        $followed_ids = $follow_ids->pluck('following_id')->toArray();
        $timelines = $post->getTimelines($user->id, $followed_ids);
        return view('follows.followerList',['timelines' => $timelines,'users'=>$users]);
    }
}
