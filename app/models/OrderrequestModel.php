<?php

class OrderrequestModel extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'orderrequest';
	//protected $appends = array('items');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');
	
	//Extra user tabel fields 
	protected $fillable = array('orid','location','provider','token','type',);
	
	public static $rules = array(
			'orid' => 'required|numeric',
			'location' => 'required|max:50',
			'provider' => 'required|alpha_num|max:50',
			'token' => 'max:255',
			'type' => 'required|max:50',
		);

}