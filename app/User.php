<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password','bio','images'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     public function getAllUsers(Int $user_id){
         return $this->Where('id', '<>', $user_id);
        }

        public function posts(){
    return $this->hasMany('App\Post');
}

     public function followers()
    {
        return $this->belongsToMany('App\User', 'follows', 'followed_id', 'following_id');
    }

    public function follows()
    {
        return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id');
    }
// フォローする処理
    public function follow($user_id)
    {
        return $this->follows()->attach($user_id);
    }
// フォロー解除する
    public function unfollow($user_id)
    {
        return $this->follows()->detach($user_id);
    }
     // フォローしているか
    public function isFollowing($user_id)
    {
        return $this->follows()->where('followed_id', $user_id)->first();
    }

    // フォローされているか
    public function isFollowed($user_id)
    {
        return $this->followers()->where('following_id', $user_id);
    }
}
