<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $primaryKey = 'category_id';
    protected $fillable = ['category_name', 'user_id', 'category_image'];

    public function user() {
    	return $this->belongsTo('App\User')->withTrashed();
    }

    public function books() {
    	return $this->hasMany('App\Book')->withTrashed();
    }
}
