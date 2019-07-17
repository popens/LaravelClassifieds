<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'listing_id', 'name', 'email', 'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var arrayphp
     */
    protected $hidden = [
        'remember_token',
    ];
}
