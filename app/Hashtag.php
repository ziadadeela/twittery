<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    protected $fillable =
        [
            'id',
            'text',
        ];

    public function tweets()
    {
        return $this->belongsToMany(Tweet::class);
    }

}
