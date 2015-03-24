<?php

class InvoiceModel extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'invoice';
	//protected $appends = array('items');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');
	
	//Extra user tabel fields 
	protected $fillable = array('orid','invoice',);
	
	public static $rules = array(
			'orid' => 'required|numeric',
			'invoice' => 'required',

		);

}