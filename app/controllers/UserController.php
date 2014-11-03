<?php

class UserController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| User Controller
	|--------------------------------------------------------------------------
	*/
        public $restful = true;

	public function login()
	{
		$logindata = array(
			'username' => Input::get('username'),
			'password' => Input::get('password')
		);
		
		//check user already loged in
		if(Auth::check())
		{
		
			return Redirect::to('/')->with('danger', 'Canot find given Email address.');
		}
			
		if(Auth::attempt($logindata))
		{
			$user = UserModel::find(Auth::user()->id);
			
			if($user->active='0')
			{
				Auth::logout();
				Session::flush();
				return Redirect::to('login');
			}
			Session::put('current_user', Input::get('username'));
			Session::put('user_access', $user->access);
			Session::put('user_id', $user->id);
			return Redirect::to('/')->with('success', 'Successfuly Login.');
			
		}else{
			return Redirect::to('login')->with('danger', 'Authenticaion Faile.');
		}
	}
	
	public function signup()
	{
		//check user already loged in
		if(Auth::check())
		{
		
			return Redirect::to('/')->with('danger', 'You are already login.');
		}
		
		$today = date("Y-m-d H:i:s");
		$signupdata = array(
			'givenname' => Input::get('givenname'),
			'surname' => Input::get('surname'),
			'email' => Input::get('email'),
			'username' => Input::get('username'),
			'password' => Input::get('password'),
			'password_confirmation' => Input::get('password_confirmation')
		);
		
		//set validation rules
		$rules = array(
			'givenname' => 'alpha_num|max:50',
			'surname' => 'alpha_num|max:50',
			'email' => 'required|unique:users,email|email|max:50',
			'username' => 'required|unique:users,username|alpha_dash|between:5,20',
			'password' => 'required|alpha_num|between:6,50|confirmed',
			'password_confirmation' => 'required|alpha_num|between:6,50',
		);
		
		//run validation check
		$validator = Validator::make($signupdata,$rules);
		if($validator->fails())
		{
			return Redirect::back()->withInput()->withErrors($validator );
		}else{
			//create new user
			$user = new UserModel;
			$user->givenname = Input::get('givenname');
			$user->surname = Input::get('surname');
			$user->email = Input::get('email');
			$user->photo = " ";
			$user->username = Input::get('username');
			$user->password = Hash::make(Input::get('password'));
			$user->active = "1";
			$user->isdel = "0";
			$user->last_login = $today;
			$user->access = "user";
			
			$user->save();
		}
		
		return Redirect::to('login')->with('success', 'You have successfuly created new account.');
	}

	public function reset()
	{
		//check user already loged in
		if(Auth::check())
		{
		
			return Redirect::to('/')->with('danger', 'You are already login.');
		}
		
		$resetdata = array(
			'email' => Input::get('email')
		);
		
		//set validation rules
		$rules = array(
			'email' => 'required|email|max:50',
		);
		
		
		//run validation check
		$validator = Validator::make($resetdata,$rules);
		if($validator->fails())
		{
			return Redirect::back()->withInput()->withErrors($validator );
		}else{
			//send rest password mail
			$user = UserModel::where('email', '=', Input::get('email'));
			
			if($user->count())
			{
				$user = $user->first();
				
				//genarate reset code and tmp password
				$resetcode = str_random(60);
				$passwd = str_random(15);
				
				//update user recode
				$user->password_temp = Hash::make($passwd); 
				$user->resetcode  = $resetcode; 
				
				if($user->save())
				{
					$data = array(
						'email' => $user->email,
						'givenname' => $user->givenname,
						'surname' => $user->surname,
						'username' => $user->username,
						'link' => URL::to('resetpassword', $resetcode),
						'password' => $passwd
					);
				}
				
				//send mail
				Mail::send('emails.auth.reminder', $data, function($message) use($user, $data)
				{
					$message->to($user->email,$user->givenname.' '.$user->surname)->subject('How to reset your Cafe Ceylon password');
					
				});
				
				return Redirect::to('login')->with('success', 'Password Reset Details Sent!');
			}
			return Redirect::to('reset')->with('danger', 'Canot find given Email address.');
		}
	}
	
	public function resetpassword($resetcode)
	{
		//check user already loged in
		if(Auth::check())
		{
		
			return Redirect::to('/')->with('danger', 'You are already login.');
		}
		
		$user = UserModel::where('resetcode', '=', $resetcode)->where('password_temp', '!=', '');
		
		//if resetcode is correct set tem password as password
		if($user->count())
		{
			$user = $user->first();
			$user->password = $user->password_temp; 
			$user->password_temp = '';
			$user->resetcode = '';
			
			if($user->save())
			{
				return Redirect::to('login')->with('success', 'Your Password is Successfully Reset!');
			}
		}
		return Redirect::to('login')->with('danger', 'Could not reset the Password. Please contact Cafe Ceylon Administrator.');
	}
}