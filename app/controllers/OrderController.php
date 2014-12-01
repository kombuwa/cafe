<?php

class OrderController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| User Controller
	|--------------------------------------------------------------------------
	*/
        public $restful = true;

	public function newOrder()
	{
		//check user already loged in
		if(Auth::check())
		{
		
			$agent = Auth::user()->username;
		}

		$today = date("Y-m-d H:i:s");
		$data = array(
			'location' => Input::get('location'),
			'description' => Input::get('description'),
		);
		
		//set validation rules
		$rules = array(
			'location' => 'required|max:50',
			'description' => 'max:50',
		);



		//run validation check
		$validator = Validator::make($data,$rules);
		if($validator->fails())
		{
			return Redirect::back()->withInput()->withErrors($validator );
		}else{
			//create new order
			$order = new OrderModel;
			$order->agent = $agent;
			$order->location = Input::get('location');
			$order->description = Input::get('description');

			
			$order->save();
		}
		
		return Redirect::to('login')->with('success', 'You have successfuly created new Order.'.$order->id);
	}


	public function editOrder($id)
    {
        $order = OrderModel::find($id);

        return View::make('admin.orderedit', array('order' => $order));
    }

}
