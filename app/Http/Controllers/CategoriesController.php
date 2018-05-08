<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Book;
use Validator;
use DB;
use Image;

class CategoriesController extends Controller
{
	private function getCategories() {
		return Category::pluck('category_name', 'category_id')->toArray();
	}

 	public function index(Request $request) {
 		$categories = Category::where(function ($query) use ($request) {
 						if ($category_name = $request->get('category_name')) {
 							$query->where('category_name', 'like', '%'.$category_name.'%');
 						}
 					})
 					->orderBy('category_id', 'DESC')
 					->paginate(10);
 		return view('categories.index', compact('categories'));
 	}   

 	private $rules = [
 		'category_name' => ['required'],
 		'category_image' => 'mimes:jpg,jpeg,png,gif'
 	];

 	public function getRequest (Request $request) {
 		$data = $request->all();

 		$data['category_name'] = strtoupper($data['category_name']);

 		date_default_timezone_set('Asia/Ho_Chi_Minh');

 		// Check image
 		if ($request->hasFile('category_image')) {
 			$category_image = 'photo_category-'.date('YmdHis').".".$request->file('category_image')->getClientOriginalExtension();
 			// echo $category_image; exit;

 			// Link save image
 			$destination = base_path().'/public/upload';

 			// Move file to destination
 			// $request->file('category_image')->move($destination, $category_image);

 			// Resize and save image
 			Image::make($request->file('category_image')->getRealPath())
 				->resize(300, 300)
 				->save($destination.'/'.$category_image);

 			$data['category_image'] = '/upload/'.$category_image;
 		}

 		return $data;
 	}

 	public function store(Request $request) {
 		// Validator
 		$validator = Validator::make($request->all(), $this->rules);

 		if ($validator->fails()) {
 			return redirect('categories')->withErrors($validator)->withInput();
 		} else {
 			$data = $this->getRequest($request);
 			// echo $data['category_image']; exit;
 			Category::create($data);
 			return redirect('categories')->with('message-category', 'Add new category success!');
 		}
 	}

 	public function update($category_id, Request $request) {
 		// Validator
 		$validator = Validator::make($request->all(), $this->rules);

 		if ($validator->fails()) {
 			return redirect('categories')->withErrors($validator)->withInput();
 		} else {
 			$data = $this->getRequest($request);

 			$category = Category::find($category_id);

 			// Delete old category_image
 			if (!empty($data['category_image']) && file_exists(public_path().$category->category_image)) {
 				unlink(public_path().$category->category_image);
 			}

 			$category->update($data);

 			return redirect('categories')->with('message-category', 'Update '.$data['category_name'].' success!');
 		}

 	}

 	public function destroy($category_id) {
 		$category = Category::find($category_id);
 		// dd($category); exit;
 		
 		// $book_id = Book::select('category_id')->where('category_id', $category_id)->get();
 		// dd($book_id); exit;

 		// Delete old category_image
		if (!empty($category['category_image']) && file_exists(public_path().$category->category_image)) {
			unlink(public_path().$category->category_image);
		}

		// DB::delete("delete from books where category_id = ?", $category_id);

		// DB::delete("delete from categories where category_id = ?", $category_id);

 		$category->delete();

 		return redirect('categories')->with('message-category', 'Delete '.$category['category_name'].' success!');
 	}
}
