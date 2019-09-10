<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Follow
 *
 * @mixin \Eloquent
 * @property int $user_id_following
 * @property int $user_id_followed
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Follow whereUserIdFollowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Follow whereUserIdFollowing($value)
 */
class Follow extends Model
{
    protected $fillable = ['user_id_following', 'user_id_followed'];


    public function followings()
    {
        return $this->hasMany(User::class,'id', 'user_id_followed');
    }

    public function followers()
    {
        return $this->hasMany(User::class,'id', 'user_id_following');
    }
}
