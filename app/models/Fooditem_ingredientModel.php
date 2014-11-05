<?php

class Fooditem_ingredientModel extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'fooditem_ingredient';
	protected $appends = array('ingredient');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');
	
	//Extra user tabel fields 
	protected $fillable = array('fiid','inid',);
	
	public static $rules = array(
			'fiid' => 'required|numeric',
			'inid' => 'required|numeric',
		);
	
	public function getIngredientAttribute()
	{
		if($this->inid==0){
		return '-';
		}else{
		$ingredient = FoodingredientModel::find($this->inid);
		return $ingredient->name;
		}
	}
}