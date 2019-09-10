<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bought extends Model
{
    protected $fillable = ['user_id', 'publi_id', 'price'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function publi()
    {
        return $this->belongsTo(Publication::class);
    }
}
