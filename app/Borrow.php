<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    protected $primaryKey = 'borrow_id';

    protected $fillable = ['book_id', 'user_id', 'date_borrow', 'date_pay', 'status'];

    // public function books () {
    // 	return $this->hasMany('App\Book');
    // }

    // public function users () {
    // 	return $this->hasMany('App\User');
    // }
}
