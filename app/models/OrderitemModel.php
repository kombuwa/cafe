<?php

class OrderitemModel extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'orderitem';
	protected $appends = array('item', 'discount', 'price');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');
	
	//Extra user tabel fields 
	protected $fillable = array('fiid','orid', 'qty');
	
	public static $rules = array(
			'fiid' => 'required|numeric',
			'orid' => 'required|numeric',
			'qty' => 'required|numeric',
		);

	public function getItemAttribute()
	{
		if($this->fiid==0){
		return '-';
		}else{
		$item = FooditemModel::find($this->fiid);
		return $item->name;
		}
	}

	public function getPriceAttribute()
	{
		if($this->fiid==0){
		return '-';
		}else{
		$item = FooditemModel::find($this->fiid);
		return $item->price;
		}
	}

	public function getDiscountAttribute()
	{
		if($this->orid==0){
		return '-';
		}else{
		$item = OrderModel::find($this->orid);
		return $item->discount;
		}
	}

	public function money($amount, $symbol = '$')
	{
		return $symbol . money_format('%i', $amount);
	}

}