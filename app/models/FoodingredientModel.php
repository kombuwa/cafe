<?php

class FoodingredientModel extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'foodingredient';
	//protected $appends = array('items');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');
	
	//Extra user tabel fields 
	protected $fillable = array('name','description','measurement',);
	
	public static $rules = array(
			'name' => 'alpha_num|max:50',
			'measurement' => 'alpha_num|max:50',
			'description' => 'alpha_num|max:255',
		);

}