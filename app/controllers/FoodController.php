<?php

class FoodController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Food Controller
	|--------------------------------------------------------------------------
	*/
        public $restful = true;

	public function getcategory($id)
	{
		return FoodcategoryModel::find($id);
	}
	
	public function getcategorys()
	{
		return FoodcategoryModel::all();
	}
	
	public function postcategory()
	{
		return FoodcategoryModel::create(Input::all());
	}
	
	public function deletecategory($id)
	{

		$items = FooditemModel::where('fcid', '=', $id)->update(array('fcid' => 0));
	
		$category = FoodcategoryModel::find($id);
		$category->delete();
		
		
		return Response::json(['destroy'=>true]);
	}
	
	public function getitem($id)
	{
		return FooditemModel::find($id);
	}
	
	public function getitems()
	{
		return FooditemModel::all();
	}
	
	public function postitem()
	{
		return FooditemModel::create(Input::all());
	}
	
	public function putitem($id)
	{
		//return FooditemModel::create(Input::all());
		/*$item= FooditemModel::find($id);
		$item->description = 'testestest';
		
		if($item->save()){
			return Response::json(['success'=>true]);
		}*/
		
		FooditemModel::find($id)->update(Input::all());
		return Response::json(['success'=>true]);
		
	}
	
	public function deleteitem($id)
	{
		$item= FooditemModel::find($id);
		$item->delete();
		
		return Response::json(['destroy'=>true]);
	}

	public function getingredient($id)
	{
		return FoodingredientModel::find($id);
	}
	
	public function getingredients()
	{
		return FoodingredientModel::all();
	}

	public function postingredient()
	{
		return FoodingredientModel::create(Input::all());
	}

	public function putingredient($id)
	{
		FoodingredientModel::find($id)->update(Input::all());
		return Response::json(['success'=>true]);
	}

	public function deleteingredient($id)
	{
		$ingredient= FoodingredientModel::find($id);
		$ingredient->delete();
		
		return Response::json(['destroy'=>true]);
	}

	public function getfooditem_ingredients($fiid)
	{
		return FooditemingredientModel::where('fiid', '=', $fiid)->get();;
	}
	
	public function postfooditem_ingredient()
	{
		return FooditemingredientModel::create(Input::all());
	}

	public function deletefooditem_ingredient($id)
	{
		$item= FooditemingredientModel::find($id);
		$item->delete();
		
		return Response::json(['destroy'=>true]);
	}

	public function getstocks()
	{
		return FoodstockModel::all();
	}
	
	public function poststock()
	{
		return FoodstockModel::create(Input::all());
	}
	
	public function deletestock($id)
	{
	
		$stock = FoodstockModel::find($id);
		$stock->delete();
		
		
		return Response::json(['destroy'=>true]);
	}
}