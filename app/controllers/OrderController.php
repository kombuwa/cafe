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

	public function newinvoice($id)
    {
    	$today = date("Y-m-d H:i:s");
    	$order = OrderModel::find($id);
    	$inv = new InvoiceModel;
    	$inv->orid = $id;
    	$inv->invoice = '
    	<div style="width:270px; text-align:center; font-size:12px; font-family:Verdana, Geneva, sans-serif;" >
    	<h3>Cafe Ceylon</h3>
        ==========================<br>
        Matara Road Kabalana, <br>
        Ahangama, Sri Lanka.<br>
        09 12282729<br>
        E mail : sales@cafeceylon.lk <br>
		==========================<br>
        '.$today.' | No: '.$order->id.' <br>
        ==========================<br>
        Waiter: '.$order->agent.' | Table: '.$order->location.' | Pax: '.$order->pax.'<br>
        ==========================<br><br>
        </div>
        <div style="width:270px; text-align:center; font-size:11px; font-family:Verdana, Geneva, sans-serif;" >
        <table width="270" border="0">
              <tr>
              	<td width="20" align="left">#</td>
                <td width="160" align="left">Item</td>
                <td width="30" align="center">Rate</td>
                <td width="25" align="center">Qty</td>
                <td width="35" align="right">Amount</td>
              </tr>';
        $orderitems =OrderitemModel::where('orid', '=', $id)->get();
		$total = 0;


        foreach ($orderitems as $orderitem) {
        	$total = $total+($orderitem->price * $orderitem->qty);
        $inv->invoice .= '<tr>
        		<td align="left">'.$orderitem->fiid.'</td>
                <td align="left">'.$orderitem->item.'</td>
                <td align="center">'.money_format('%i', $orderitem->price).'</td>
                <td align="center">'.$orderitem->qty.'</td>
                <td align="right">'.money_format('%i', $orderitem->price * $orderitem->qty).'</td>
              </tr>';
        }
        $dis = ($total/100)*$orderitem->discount;
        $net = ($total-(($total/100)*$orderitem->discount));
        $inv->invoice .= '</table>
        </div>
        <div style="width:270px; text-align:center; font-size:12px; font-family:Verdana, Geneva, sans-serif;" >
            ==========================<br>
        </div>
        <div style="width:270px; text-align:center; font-size:12px; font-family:Verdana, Geneva, sans-serif;" >
            <table width="270" border="0">
              <tr>
                <td align="left">Gross Amount </td>
                <td align="right">'.money_format('%i', $total).'</td>
              </tr>
              <tr>
                <td align="left">Discounts '.$orderitem->discount.'%</td>
                <td align="right">'.money_format('%i', $dis).'</td>
              </tr>
              <tr>
                <td align="left">Net Amount </td>
                <td align="right">'.money_format('%i', $net).'</td>
              </tr>
            </table></div>
            <div style="width:270px; text-align:center; font-size:12px; font-family:Verdana, Geneva, sans-serif">
        
	        ==========================<br>
	        Thank You for visiting cafe ceylon <br>
	        Please visit us again<br>
			cafeceylon.lk<br>
        	<br>
        	</div>';

    	$inv->save();
    	return Redirect::to('order/print/'.$order->id);
	}

	public function getinvoice($id)
	{
		 return InvoiceModel::where('orid', '=', $id)->first();
	}

	public function getkot($id)
	{
		 return OrderrequestModel::where('orid', '=', $id)->where('provider', '=', 'kitchen')->orderBy('created_at', 'desc')->first();
	}

	public function getbot($id)
	{
		 return OrderrequestModel::where('orid', '=', $id)->where('provider', '=', 'bar')->orderBy('created_at', 'desc')->first();
	}
	
	public function postitem()
	{
		return OrderitemModel::create(Input::all());
	}

	public function getdiscount()
	{

		$order = OrderModel::find(Input::get('id'));
		$order->discount = Input::get('discount');
		$order->save();
		return Response::json(['success'=>true]);
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

	public function fullKot($id)
    {
    	$today = date("Y-m-d H:i:s");
    	$order = OrderModel::find($id);
    	$kot = new OrderrequestModel;
    	$kot->orid = $id;
    	$kot->location = $order->location;
    	$kot->provider = "kitchen";
    	$kot->token = '
    	<div style="width:270px; text-align:center; font-size:12px; font-family:Verdana, Geneva, sans-serif;" >
    	<h3>Cafe Ceylon - KOT</h3>
    	==========================<br>
        '.$today.' | No: '.$order->id.' <br>
        ==========================<br>
        Waiter: '.$order->agent.' | Table: '.$order->location.' | Pax: '.$order->pax.'<br>
        ==========================<br><br>
    	</div>
    	<table width="270" border="0">
              <tr>
              	<td width="20" align="left">#</td>
                <td width="160" align="left">Item</td>
                <td width="30" align="center">Provider</td>
                <td width="25" align="center">Qty</td>
              </tr>
    	';
    	$orderitems =OrderitemModel::where('orid', '=', $id)->get();
		$total = 0;


        foreach ($orderitems as $orderitem) {
        	//$total = $total+($orderitem->price * $orderitem->qty);
        	if($orderitem->provider=="kitchen"){
        $kot->token .= '<tr>
        		<td align="left">'.$orderitem->fiid.'</td>
                <td align="left">'.$orderitem->item.'</td>
                <td align="center">'.$orderitem->provider.'</td>
                <td align="center">'.$orderitem->qty.'</td>

              </tr>';
          	}
        }
        $kot->token .= '</table>';
    	$kot->type = "full";
    	$kot->save();
    	return Redirect::to('kot/print/'.$order->id);
    }

    public function printKot($id)
    {
        return View::make('admin.kotprint')->with('searchId', $id)->with('title','Print KOT');
    }

    public function fullBot($id)
    {
    	$today = date("Y-m-d H:i:s");
    	$order = OrderModel::find($id);
    	$kot = new OrderrequestModel;
    	$kot->orid = $id;
    	$kot->location = $order->location;
    	$kot->provider = "bar";
    	$kot->token = '
    	<div style="width:270px; text-align:center; font-size:12px; font-family:Verdana, Geneva, sans-serif;" >
    	<h3>Cafe Ceylon - BOT</h3>
    	==========================<br>
        '.$today.' | No: '.$order->id.' <br>
        ==========================<br>
        Waiter: '.$order->agent.' | Table: '.$order->location.' | Pax: '.$order->pax.'<br>
        ==========================<br><br>
    	</div>
    	<table width="270" border="0">
              <tr>
              	<td width="20" align="left">#</td>
                <td width="160" align="left">Item</td>
                <td width="30" align="center">Provider</td>
                <td width="25" align="center">Qty</td>
              </tr>
    	';
    	$orderitems =OrderitemModel::where('orid', '=', $id)->get();
		$total = 0;


        foreach ($orderitems as $orderitem) {
        	//$total = $total+($orderitem->price * $orderitem->qty);
        	if($orderitem->provider=="bar"){
        $kot->token .= '<tr>
        		<td align="left">'.$orderitem->fiid.'</td>
                <td align="left">'.$orderitem->item.'</td>
                <td align="center">'.$orderitem->provider.'</td>
                <td align="center">'.$orderitem->qty.'</td>

              </tr>';
          	}
        }
        $kot->token .= '</table>';
    	$kot->type = "full";
    	$kot->save();
    	return Redirect::to('bot/print/'.$order->id);
    }

    public function printBot($id)
    {
        return View::make('admin.botprint')->with('searchId', $id)->with('title','Print BOT');
    }

}
