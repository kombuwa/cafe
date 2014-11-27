<?php

class OrderModel extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'orders';
	//protected $appends = array('items');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');
	
	//Extra user tabel fields 
	protected $fillable = array('agent','location','description',);
	
	public static $rules = array(
			'agent' => 'required|alpha_num|max:50',
			'location' => 'alpha_num|max:50',
			'description' => 'alpha_num|max:255',
		);

}