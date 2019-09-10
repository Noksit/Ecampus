<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Message
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message findConversation($userId, $otherUserId)
 * @mixin \Eloquent
 * @property int $id
 * @property int $from_user_id
 * @property int $to_user_id
 * @property string $content
 * @property string|null $read_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereFromUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereToUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereUpdatedAt($value)
 */
class Message extends Model
{
    protected $fillable = ['content', 'from_user_id', 'to_user_id'];


    public function scopeFindConversation($query, $userId, $otherUserId)
    {

        return $query->where([
                ['from_user_id', '=', $userId],
                ['to_user_id', '=', $otherUserId],
            ])->orWhere([
                ['from_user_id', '=', $otherUserId],
                ['to_user_id', '=', $userId],
            ]);
    }

    public function scopeFindUnreadMessage($query, $userId, $otherUserId)
    {
        return $query->where([
            ['from_user_id', '=', $otherUserId],
            ['to_user_id', '=', $userId],
            ['read_at', null],
        ]);
    }
}
