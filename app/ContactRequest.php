<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\ContactRequest
 *
 * @property-read \App\User $user
 * @mixin \Eloquent
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $user_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContactRequest whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContactRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContactRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContactRequest whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContactRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContactRequest whereUserId($value)
 */
class ContactRequest extends Model
{

    use SoftDeletes;

    protected $fillable = ['title','content','user_id'];


    public function user(){
        return $this->belongsTo('App\User');
    }

}
