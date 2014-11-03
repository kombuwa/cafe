<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class UserModel extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
	
	//Extra user tabel fields 
	protected $fillable = array('givenname', 'surname', 'username', 'email', 'photo', 'password', 'access', 'isdel', 'active', 'last_login', );
	
	public static $rules = array(
			'givenname' => 'alpha_num|max:50',
			'surname' => 'alpha_num|max:50',
			'email' => 'required|unique:users,email|email|max:50',
			'username' => 'required|unique:users,username|alpha_dash|between:5,20',
			'password' => 'required|alpha_num|between:6,50|confirmed',
			'password_confirmation' => 'required|alpha_num|between:6,50',
		);
}
