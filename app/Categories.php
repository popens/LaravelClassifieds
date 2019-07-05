<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Listings;
class Categories extends Model
{
    public $table = 'categories';
    protected $fillable = array('category_id', 'listing_id', 'user_id');
}
