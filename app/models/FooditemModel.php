<?php

class FooditemModel extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'fooditem';
	protected $appends = array('category', 'ingredients');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');
	
	//Extra user tabel fields 
	protected $fillable = array('fcid','name','photo','provider','description','price');
	
	public static $rules = array(
			'name' => 'alpha_num|max:50',
			'provider' => 'alpha_num|max:50',
			'description' => 'alpha_num|max:255',
			'price' => 'required|numeric',
		);
	
	public function getCategoryAttribute()
	{
		if($this->fcid==0){
		return '-';
		}else{
		$category = FoodcategoryModel::find($this->fcid);
		return $category->name;
		}
	}

	public function getIngredientsAttribute()
	{
		//$item= FooditemModel::where('fcid', '=', $this->id)->firstOrFail();
		return FooditemingredientModel::where('fiid', '=', $this->id)->count();;
	}
}