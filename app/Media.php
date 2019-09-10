<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Media
 *
 * @property-read \App\Publication $publication
 * @property-read \App\User $user
 * @mixin \Eloquent
 * @property int $id
 * @property string $title
 * @property string $type_mime
 * @property string $file_path
 * @property int $publication_id
 * @property int $user_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media wherePublicationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereTypeMime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereUserId($value)
 */
class Media extends Model
{
    protected $fillable = ['title', 'type_mime', 'file_path'];

    public function publication()
    {
        return $this->belongsTo('App\Publication');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}