<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Category
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Publication[] $post
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Publication[] $publication
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Publication[] $tuto
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereName($value)
 */
class Category extends Model
{
    public $timestamps = false;

    public function publication()
    {
        return $this->hasMany('App\Publication');
    }

    public function tuto()
    {
        return $this->hasMany('App\Publication')->where('type','tutorial');
    }

    public function post()
    {
        return $this->hasMany('App\Publication')->where('type','post');
    }

}
