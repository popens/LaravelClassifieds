<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    public $table = 'categories';
    public function listings() {
		return $table->belongsToMany('App/Listings', 'listing_id');
	}
}
