<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['rate','publication_id','user_id'];

    public function getPublicationRated()
    {
        $this->hasOne('App\Publications');
    }
}
