<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Event;

use Illuminate\Support\Facades\Mail;

class SessionController extends Controller
{
	public function create()
	{
		return view('login');
	}
	public function store(Request $request)
	{
		if(Auth::attempt(['email' =>Input::get('email'), 'password' => Input::get('password'),'is_active' => '1']))
		{

			return Redirect::to('/post');
		}
		else {
			Session::flash('message', 'Enter Valid Email Address And Password');
			Session::flash('alert-class', 'alert-danger');
			return Redirect::back();
		}
	}
	public function logout()
	{
		Auth::logout();
		return Redirect::to('/');
	}

	public function register($id=NULL)
	{
		if(isset($id)){

			$user=User::find($id);
			$user->is_active='1';
			$user->save();
			return Redirect::to('/');

		}
		return view('register');
	}

	public function doregister()
	{
        var_dump($_POST);

				$rules=array(
						'fname'=>'required|min:2',
						'lname'=>'required|min:2',
						'password'=>'required|min:8',
						'email'=>'required|unique:user,email',
				);
				$validator=Validator::make(Input::all(),$rules);
				if($validator->fails()){
						return Redirect::back()->withErrors($validator)->withInput();
				}

				$user=new user();
				$user->fname=Input::get('fname');
				$user->lname=Input::get('lname');
				$user->email=Input::get('email');
				$user->password=Hash::make(Input::get('password'));

				if($user->save()){
					Event::fire(new UserRegistered($user));
					Session::flash('message', 'Your Registration Done SuccessFully Now You Can Login');
					Session::flash('alert-class', 'alert-success');
					return Redirect::back();
				}else{
					Session::flash('message', 'Try After Some Timess');
					Session::flash('alert-class', 'alert-danger');
					return Redirect::back();
				}

	}
}
