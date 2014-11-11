<?php

class FoodstockModel extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'foodstock';
	//protected $appends = array('items');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');
	
	//Extra user tabel fields 
	protected $fillable = array('inid','isauto','type','cause','qty',);
	
	public static $rules = array(
			'inid' => 'required|numeric',
			'isauto' => 'alpha_num|max:5',
			'type' => 'alpha_num|max:5',
			'cause' => 'alpha_num|max:255',
			'qty' => 'required|numeric',
		);

}