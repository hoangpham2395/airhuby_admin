<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Borrow;
use App\User;

class BorrowController extends Controller
{
    public function index(Request $request) {
    	$borrows = Borrow::where(function($query) use ($request) {
    						if ($request->get("filter") == "borrow") {
    							$query->whereDate('date_pay', '>=', date('Y-m-d'));
							} elseif ($request->get("filter") == "pay") {
								$query->whereDate('date_pay', '<', date('Y-m-d'));
							}
    					})
    					->join('users', 'borrows.user_id', '=', 'users.user_id')
    					->join('books', 'books.book_id', '=', 'borrows.book_id')
    					->orderBy('borrow_id', 'DESC')
    					->paginate(10);
    	return view('borrows.index', compact('borrows'));
    }
}
