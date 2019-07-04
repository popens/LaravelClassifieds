<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Categories;
use App\ListingsRelation;

class Listings extends Model
{
    protected $table = 'listings';
	protected $primaryKey = 'id';
	protected $fillable = array('title', 'slug', 'description', 'price', 'image');

	public function categories() {
		return $this->belongsToMany('App\Categories', 'listings_relation', 'listing_id', 'category_id');
	}
}
