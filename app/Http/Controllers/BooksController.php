<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Category;
use App\User;
use Validator;
use Image;

class BooksController extends Controller
{
    // Get data from Category => Form::select()
    private function getCategories() {
        return Category::pluck('category_name', 'category_id')->toArray();
    }

    // Get data from User => Form::select()
    private function getUsers() {
        return User::pluck('user_name', 'user_id')->toArray();
    }

    public function index(Request $request) {
        $books = Book::where(function ($query) use ($request){
                    if ($category_id = $request->get('category_id')) {
                        $query->where('books.category_id', '=', $category_id);
                    }
                    if ($book_title = $request->get('book_title')) {
                        $query->where('books.book_title', 'like', '%'.$book_title.'%');
                    }
                })
                ->join('users', 'books.user_id', '=', 'users.user_id')
                ->join('categories', 'books.category_id', '=', 'categories.category_id')
                ->orderBy('books.book_id', 'DESC')
                ->paginate(10);
        $categories = $this->getCategories();
        return view("books.index", compact('books', 'categories'));
    }

    public function create() {
        $categories = $this->getCategories();
        $users = $this->getUsers();
        return view("books.create", compact('categories', 'users'));
    }

    public function show($book_id) {
        $book = Book::join('users', 'books.user_id', '=', 'users.user_id')
                ->join('categories', 'books.category_id', '=', 'categories.category_id')
                ->where('books.book_id', $book_id)
                ->first();
        return view("books.show", compact('book'));
    }

    public function edit($id) {
        $book = Book::join('users', 'books.user_id', '=', 'users.user_id')
                ->join('categories', 'books.category_id', '=', 'categories.category_id')
                ->where('books.book_id', $id)
                ->first();
        $categories = $this->getCategories();
        $users = $this->getUsers();
        return view("books.edit", compact('book', 'categories', 'users'));
    }

    // Validate
    private $rules = [
        'book_title' => ['required'],
        'book_description' => ['required'],
        'book_content' => ['required'],
        'category_id' => ['required'],
        'book_price' => ['required', 'numeric', 'min:0'],
        'user_id' => ['required'],
        'image_before' => ['mimes:jpg,jpeg,png,gif'],
        'image_after' => ['mimes:jpg,jpeg,png,gif'],
        'book_count' => ['integer','min:0']
    ];

    // Get data from FORM
    public function getRequest(Request $request) {
        $data = $request->all();

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data['date_upload'] = date('Y-m-d H:i:s');

        if (is_null($data['book_count'])) $data['book_count'] = 0;

        // Check image_before
        if ($request->hasFile('image_before')) {
            $image = $request->file('image_before');

            // Get name of file
            $image_before = $image->getClientOriginalName();
            // echo $image_before; exit;

            // Link file image
            $destination = base_path().'/public/upload';
            // echo $destination; exit;

            // Change name
            $image_before = 'photo-'.date('YmdHis').'1.'.$image->getClientOriginalExtension();
            // echo $image_before; exit();

            //Di chuyển ảnh đến folder lưu trữ
            // $image->move($destination, $image_before);

            // Resize and save image
            Image::make($request->file('image_before')->getRealPath())->resize(300, 300)->save($destination.'/'.$image_before);

            $data['image_before'] = '/upload/'.$image_before;
        }

        // Check image_after
        if ($request->hasFile('image_after')) {
            // Get name of file
            $image_after = $request->file('image_after')->getClientOriginalName();
            // echo $image_before; exit;

            // Link file image
            $destination = base_path().'/public/upload';
            // echo $destination; exit;

            // Change name
            $image_after = 'photo-'.date('YmdHis').'2.'.$request->file('image_after')->getClientOriginalExtension();
            // echo $image_after; exit();

            //Di chuyển ảnh đến folder lưu trữ
            // $request->file('image_after')->move($destination, $image_after);

            // Resize and save image
            Image::make($request->file('image_after')->getRealPath())->resize(300, 300)->save($destination.'/'.$image_after);

            $data['image_after'] = '/upload/'.$image_after;
        }

        return $data;
    }

    public function store(Request $request) {
        // Validator
        $validator = Validator::make($request->all(), $this->rules);

        // Validator fail
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } 
        else 
        // Validator success
        {
            $data = $this->getRequest($request);

            // echo $data['image_before']; exit;

            $book = Book::create($data);

            return redirect()->route('books.show', $book->book_id)->with('message-book', 'Add new book "'.$data['book_title'].'" success!');
        }
    }

    public function update($book_id, Request $request) {
        // Validator
        $validator = Validator::make($request->all(), $this->rules);

        // Validator fail
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } 
        else 
        // Validator success
        {   
            $book = Book::where('book_id', $book_id)->first();

            // dd($book); exit;

            $data = $this->getRequest($request);
            // dd($data); exit;

            // if (is_null($book->image_before)) { echo 'hello'; exit;}

            // Delete old image
            if (!empty($data['image_before']) && (file_exists(base_path().'/public'.$book->image_before))) {
                unlink(base_path().'/public'.$book->image_before);
                //echo base_path().'/public/upload/'.$book->image_before; exit;
            }
            if (!empty($data['image_after']) && (file_exists(base_path().'/public'.$book->image_after))) {
                unlink(base_path().'/public'.$book->image_after);
            }

            $book->update($data);

            return redirect()->route('books.show', $book->book_id)->with('message-book', 'Update "'.$data['book_title'].'" saved!');
        }
    }

    public function destroy($book_id) {
        $book = Book::where('book_id',$book_id)->first();

        // dd($book); exit;

        // Delete image
        if (!empty($book->image_before)) {
            // Get link
            $file_path = base_path().'/public/upload/'.$book->image_before;
            // echo $file_path; exit;

            // Check and delete
            if (file_exists($file_path)) unlink($file_path);
        }

        $book->delete();

        return redirect('books')->with('message-book', 'Delete success!');

    }
}
