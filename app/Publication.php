<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Publication
 *
 * @property-read \App\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comment
 * @property-read \App\Consultation $consultation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Media[] $media
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication findSimilarSlugs($attribute, $config, $slug)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Publication onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication tuto()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereSlug($slug)
 * @method static \Illuminate\Database\Query\Builder|\App\Publication withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Publication withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property string $type
 * @property string|null $imgpublication
 * @property float|null $price
 * @property string $title
 * @property string $slug
 * @property string|null $description
 * @property string $content
 * @property string|null $goals
 * @property string|null $required
 * @property string|null $deleted_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $category_id
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereGoals($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereImgpublication($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereUserId($value)
 */
class Publication extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;
    use SoftDeletes;

    protected $fillable = ['type',
        'imgpublication',
        'price',
        'title',
        'slug',
        'description',
        'content',
        'goals',
        'required',
        'category_id',
        'user_id'
    ];

    protected $perPage = 10;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function scopeTuto()
    {
        return $this->where('type', 'tutorial');
    }

    public function scopePost()
    {
        return $this->where('type', 'post');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function consultation()
    {
        return $this->hasOne('App\Consultation');
    }

    public function media()
    {
        return $this->hasMany('App\Media');
    }


    public function comment()
    {
        return $this->hasMany('App\Comment')->latest();
    }

    public function userOwner()
    {
        return $this->belongsToMany(User::class, 'boughts', 'publi_id', 'user_id');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }


}
