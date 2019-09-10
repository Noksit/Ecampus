<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * App\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comment
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $followers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $followings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Media[] $media
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Publication[] $post
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Publication[] $publication
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Publication[] $tutorial
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User findSimilarSlugs($attribute, $config, $slug)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\User onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSlug($slug)
 * @method static \Illuminate\Database\Query\Builder|\App\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\User withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $imgprofil
 * @property string $firstname
 * @property string $slug
 * @property \Carbon\Carbon|null $birthday
 * @property string $email
 * @property string $password
 * @property string|null $paypal
 * @property string|null $description
 * @property string|null $role
 * @property string|null $provider
 * @property string|null $provider_id
 * @property string|null $deleted_at
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereImgprofil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePaypal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 */
class User extends Authenticatable
{
    use Notifiable;
    use Sluggable;
    use SluggableScopeHelpers;
    use SoftDeletes;
    use hasApiTokens;
    use SluggableScopeHelpers;


    protected $dates = ['birthday'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['firstname', 'name'],
                'separator' => '-'
            ],
        ];
    }

    protected $fillable = [
        'name',
        'firstname',
        'password',
        'email',
        'paypal',
        'birthday',
        'description',
        'provider',
        'provider_id'
    ];

    protected $hidden = ['password'];

    public function publication()
    {
        return $this->hasMany('App\Publication')->orderBy('created_at', 'desc');
    }

    public function post()
    {
        return $this->hasMany('App\Publication')->where('type', '=', 'post')->orderBy('created_at', 'desc');
    }

    public function tutorial()
    {
        return $this->hasMany('App\Publication')->where('type', '=', 'tutorial')->orderBy('created_at', 'desc');
    }

    public function media()
    {
        return $this->hasMany('App\Media');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id_followed', 'user_id_following');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id_following', 'user_id_followed');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    public function postsBought()
    {
        return $this->belongsToMany(Publication::class, 'boughts', 'user_id', 'publi_id');
    }

    public function unreadMessageByUser()
    {
        return $this->hasMany('App\Message', 'from_user_id')
            ->where('read_at', '=', null);

    }
    public function unreadMessage()
    {
        return $this->hasMany('App\Message', 'to_user_id')
            ->where('read_at', '=', null);
    }

    public function like()
    {
        return $this->hasMany('App\Like');
    }
}
