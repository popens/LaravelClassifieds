<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Listings extends Model
{
    protected $table = 'listings';
	protected $primaryKey = 'id';

	protected $fillable = array('title', 'slug', 'description', 'price', 'image');
}
