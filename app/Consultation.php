<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Consultation
 *
 * @property-read \App\Publication $publication
 * @property-read \App\User $user
 * @mixin \Eloquent
 * @property int $id
 * @property int $occurrences
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int|null $rating
 * @property int $publication_id
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Consultation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Consultation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Consultation whereOccurrences($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Consultation wherePublicationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Consultation whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Consultation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Consultation whereUserId($value)
 */
class Consultation extends Model
{

    protected $fillable = ['publication_id', 'user_id'];

    public function publication()
    {
        return $this->belongsTo('App\Publication');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function consultation()
    {
        //
    }
}
