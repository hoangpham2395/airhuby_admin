<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Book;
use App\Borrow;
use Illuminate\Support\Facades\Hash;
use Validator;
use Image;

class UsersController extends Controller
{   
    public function dashboard () {
        $users = User::where('user_role', 'user')->orderBy('user_id', "DESC")->get();
        $categories = Category::get();
        $books = Book::orderBy('book_id', 'DESC')->get();
        $borrows = Borrow::get();
        return view ('users.dashboard', compact('users', 'books', 'categories', 'borrows'));
    }

    public function index (Request $request) {
    	$users = User::where(function ($query) use ($request) {
    				if ($user_name = $request->get('user_name')) {
    					$query->where('user_name', 'like', '%'.$user_name.'%');
    				}
    				if ($user_email = $request->get('user_email')) {
    					$query->where('user_email', 'like', '%'.$user_email.'%');
    				}
    				if ($user_phone = $request->get('user_phone')) {
    					$query->where('user_phone', 'like', '%'.$user_phone.'%');
    				}
    				if ($user_address = $request->get('user_address')) {
    					$query->where('user_address', 'like', '%'.$user_address.'%');
    				}
    			})
    			->orderBy('users.user_id', 'DESC')
    			->paginate(10);
    	return view ('users.index', compact('users', 'query'));
    }

    public function show ($user_id) {
    	$user = User::find($user_id);
    	return view('users.show', compact('user'));
    }

    public function create () {
    	return view('users.create');
    }

    public function edit ($user_id) {
    	$user = User::find($user_id);
    	return view('users.edit', compact('user'));
    }

    private $rules = [
    	'user_name' => ['required'],
    	'user_email' => ['required', 'email'],
    	'user_phone' => ['required'],
    	'user_address' => ['required'],
    	'user_avatar' => ['mimes:jpg,jpeg,png,gif'],
    	'user_password' => ['min:6'],
    	'password_confirmation' => ['required_with:user_password', 'same:user_password', 'min:6'],
    	'coinNumber' => ['integer']
    ];

    private function getRequest(Request $request) {
    	$data = $request->all();

    	if (!empty($data['user_password'])) {
	    	$data['user_password'] = bcrypt($data['user_password']);
	    	$data['password_confirmation'] = bcrypt($data['password_confirmation']);
	    }

    	date_default_timezone_set('Asia/Ho_Chi_Minh');

    	// Check avatar
    	if ($request->hasFile('user_avatar')) {
    		// Change name
    		$avatar = 'avatar-'.date('YmdHis').'.'.$request->file('user_avatar')->getClientOriginalExtension();

    		// Link save avatar
    		$destination = public_path().'/upload';

    		// Move image to destination
    		// $request->file('user_avatar')->move($destination, $avatar);

            // Resize and save
            Image::make($request->file('user_avatar')->getRealPath())
                    ->resize(300, 300)
                    ->save($destination.'/'.$avatar);

    		$data['user_avatar'] = '/upload/'.$avatar;
    	} 

    	return $data;
    }

    public function store (Request $request) {
    	// Validator
    	$validator = Validator::make($request->all(), $this->rules);

    	if ($validator->fails()) {
    		return redirect()->back()->withErrors($validator)->withInput();
    	} else {
    		$data = $this->getRequest($request);
    		// dd($data); exit;

    		User::create($data);

    		return redirect('users')->with('message-user', 'Add new user success!');
    	}
    }

    public function update ($user_id, Request $request) {
    	// Validator
    	$validator = Validator::make($request->all(), $this->rules);

    	if ($validator->fails()) {
    		return redirect()->back()->withErrors($validator)->withInput();
    	} else {
    		$data = $this->getRequest($request);
    		$user = User::find($user_id);

    		// if (file_exists(public_path().$user->user_avatar)) {
    		// dd($user); exit;}

    		//Delete old avatar
    		if ((!empty($data['user_avatar'])) && (!empty($user->user_avatar)) && (file_exists(public_path().$user->user_avatar))) {
    			unlink(public_path().$user->user_avatar);
    		} 

    		$user->update($data);

    		return redirect("users/".$user->user_id)->with('message-user', 'Edit information success!');
    	}
    }

    public function destroy ($user_id) {
        $user = User::find($user_id);

        // Delete avatar
        if ((!empty($user->user_avatar)) && (file_exists(public_path().$user->user_avatar))) {
            unlink(public_path().$user->user_avatar);
        }

        $user->delete();

        return redirect('users')->with('message-user', 'Delete '.$user->user_name.' success!');
    }

    public function getPassword ($user_id) {
    	$user = User::findOrFail($user_id);
    	return view('users.changePassword', compact('user'));
    }

    public function changePassword ($user_id, Request $request) {
        $user = User::findOrFail($user_id);
        // Validator
        $validator = Validator::make($request->all(), [
            'old_password' => ['required'], 
            'new_password' => ['required', 'min:6'],
            'password_confirmation' => ['required_with:new_password', 'same:new_password', 'min:6']
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $data = $request->all();

            // echo bcrypt($data['old_password']).'<br>'.$user->user_password; exit;

            if (Hash::check($data['old_password'], $user->user_password)) {
                $user->update(['user_password', Hash::make($data['new_password'])]);
                return redirect("users/".$user->user_id)->with('message-user', 'Change password success!');
            } else {
                $errors['changePassword'] = 'Old password is wrong.';
                return redirect()->back()->withErrors($errors);
            }
        }
    }
}
