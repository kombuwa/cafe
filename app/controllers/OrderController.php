<?php

class OrderController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| User Controller
	|--------------------------------------------------------------------------
	*/
        public $restful = true;

	public function new()
	{
		return View::make('hello');
	}

}
