<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id', 'publication_id'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function publication()
    {
        return $this->hasOne('App\Publication');
    }
}
