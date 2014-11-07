<?php

class FooditemingredientModel extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'fooditem_ingredient';
	protected $appends = array('ingredient', 'measurement');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');
	
	//Extra user tabel fields 
	protected $fillable = array('fiid','inid', 'qty');
	
	public static $rules = array(
			'fiid' => 'required|numeric',
			'inid' => 'required|numeric',
			'qty' => 'required|numeric',
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

	public function getMeasurementAttribute()
	{
		if($this->inid==0){
		return '-';
		}else{
		$ingredient = FoodingredientModel::find($this->inid);
		return $ingredient->measurement;
		}
	}
}