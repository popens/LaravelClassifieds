<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class ListingsRelation extends Model
{
    protected $table = 'listings_relation';
	protected $primaryKey = 'id';
    protected $fillable = array('category_id', 'listing_id', 'user_id');
}
