<?php

class FoodcategoryModel extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'foodcategory';
	protected $appends = array('items');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');
	
	//Extra user tabel fields 
	protected $fillable = array('name','photo',);
	
	public static $rules = array(
			'name' => 'alpha_num|max:50',
		);
	
	public function getItemsAttribute()
	{
		//$item= FooditemModel::where('fcid', '=', $this->id)->firstOrFail();
		return FooditemModel::where('fcid', '=', $this->id)->count();;
	}
}