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
			'agent' => Input::get('agent'),
			'pax' => Input::get('pax'),
			'description' => Input::get('description'),
		);
		
		//set validation rules
		$rules = array(
			'location' => 'required|max:50',
			'agent' => 'required|max:50',
			'pax' => 'required',
			'description' => 'max:250',
		);



		//run validation check
		$validator = Validator::make($data,$rules);
		if($validator->fails())
		{
			return Redirect::back()->withInput()->withErrors($validator );
		}else{
			//create new order
			$order = new OrderModel;
			$order->agent = Input::get('agent');
			$order->location = Input::get('location');
			$order->pax = Input::get('pax');
			$order->description = Input::get('description');

			
			$order->save();
		}
		
		return Redirect::to('order/edit/'.$order->id)->with('success', 'You have successfuly created new Order.'.$order->id);
	}


	public function editOrder($id)
    {
        //$order = OrderModel::find($id);
    	//return View::make('admin.orderedit', array('order' => $order))->with('title','Edit Order');
        return View::make('admin.orderedit')->with('searchId', $id)->with('title','Edit Order');
    }

    public function printOrder($id)
    {
        return View::make('admin.orderprint')->with('searchId', $id)->with('title','Print Order');
    }

    public function getorder($id)
	{
		return OrderModel::find($id);
	}

	public function getorders()
	{
		return OrderModel::all();
	}

	public function postitem()
	{
		return OrderitemModel::create(Input::all());
	}

	public function putitem($id)
	{
		OrderitemModel::find($id)->update(Input::all());
		return Response::json(['success'=>true]);
	}
	
	public function getitems($id)
	{
		return OrderitemModel::where('orid', '=', $id)->get();
	}

	public function deleteitem($id)
	{
	
		$item = OrderitemModel::find($id);
		$item->delete();
		
		
		return Response::json(['destroy'=>true]);
	}

	public function pitem($id)
	{
		$item = OrderitemModel::find($id);
		$item->qty = $item->qty+1;
		$item->save();

		return Response::json(['success'=>true]);	
	}

	public function nitem($id)
	{
		$item = OrderitemModel::find($id);
		if($item->qty>1){
			$item->qty = $item->qty-1;
			$item->save();
		}
		return Response::json(['success'=>true]);
	}
}
