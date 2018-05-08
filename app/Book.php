<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
	protected $primaryKey = 'book_id';

    protected $fillable = [
    	'book_title', 'book_description', 'book_content', 'category_id', 'user_id', 'image_before', 'image_after', 'book_price', 'book_count', 'date_upload'
    ];

    public function category() {
    	return $this->belongsTo('App\Category');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
