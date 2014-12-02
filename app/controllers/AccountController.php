<?php

class AccountController extends \BaseController {

	
	public function get_home(){
		return View::make('home');
	}
	public function get_login(){
		return View::make('account.login');
	}

	public function get_logout(){
		Auth::logout();
		return Redirect::route('account-login');	
	}

	public function post_login(){
		$validator = Validator::make(Input::all(),
			array(
				'username'		=>	'required|max:20',
				'password'	=>	'required'));

		if($validator->fails()){
			return Redirect::route('account-login')
			->withErrors($validator)
			->withInput();
		}
		else{

			$remember = (Input::has('remember'))? true: false;

			$password = Hash::make(Input::get('password'));

			$auth = Auth::attempt(array(
				'username'		=>	Input::get('username'),
				'password'	=>	Input::get('password')), $remember);

			if($auth){
				$active =  (bool)Auth::user()->active;
				if($active == true){
					return Redirect::intended('/');
				}
				else{
					Auth::logout();
					return Redirect::route('account-login')
					->with('message', 'Your account has not been activated. Please contact you Sacco for assistance')
					->with('type', 'danger');
				}
			}
			else{
				return Redirect::route('account-login')
				->with('message', 'Email/ Password incorrect')
				->with('type', 'danger');
			}
		}
	}

	public function get_signup(){		
		return View::make('account.signup');
	}

	public function post_signup(){
		$data = Input::all();
		$data['temp_code']		= str_random(60);
		$data['active'] 	= 1;
		$messages = array(
			'unique' 	=> 'Account for ' . $data['email'] . 'already exists. Please sign in.',
			'same'		=> 'The \'Password\'  and \'confirm password\' do not match',
			'required'	=> 'All the fields are mandatory');
		$validator = Validator::make($data, User::rules(), $messages);
		if($validator->fails()){
			return Redirect::route('account-signup')
			->withErrors($validator)
			->withInput();
		}
		else
		{
			$password = Hash::make($data['password']);
			$data['password'] = $password;

			$user = User::create($data);
			if($user){
				return Redirect::intended('/');
			}
			else{
				return Redirect::route('account-signup')
				->with('message', 'The registration process cannot be completed at the moment. Please try again later')
				->with('type', 'danger');
			}
		}
	}

	public function get_signup_success(){
		return View::make('account.signup-success');
	}

	public function get_forgotpassword(){

	}

	public function post_forgotpassword(){

	}
}
