<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $primaryKey = [
        'following_id',
        'followed_id'
    ];
    protected $fillable = [
        'following_id',
        'followed_id'
    ];

    public function followingIds($user_id)
  {
      return $this->where('following_id', $user_id)->get();
  }

  public function followedIds($user_id)
  {
      return $this->where('followed_id', $user_id)->get();
  }

  public function follows(){
  return $this->hasMany('App\Follow');
}
    public $timestamps = false;
    public $incrementing = false;
}
