<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Listings;
class Categories extends Model
{
    public $table = 'categories';
    protected $fillable = array('category_id', 'listing_id');
    
    public function listings()
    {
        return $this->belongsToMany('App\Listings', 'listing_id');
    }
}
